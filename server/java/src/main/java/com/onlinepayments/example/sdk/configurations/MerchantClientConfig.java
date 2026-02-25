package com.onlinepayments.example.sdk.configurations;

import com.onlinepayments.*;
import com.onlinepayments.authentication.*;
import com.onlinepayments.communication.*;
import com.onlinepayments.merchant.MerchantClient;

import org.springframework.beans.factory.annotation.Value;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

import java.net.URI;
import java.util.concurrent.TimeUnit;

@Configuration
public class MerchantClientConfig
{
    @Value("${merchantId}")
    private String merchantId;

    @Value("${apiKey}")
    private String apiKey;

    @Value("${apiSecret}")
    private String apiSecret;

    @Value("${apiEndpoint}")
    private String apiEndpoint;

    @Bean
    public CommunicatorConfiguration communicatorConfiguration() {
        return new CommunicatorConfiguration()
                .withApiKeyId(apiKey)
                .withSecretApiKey(apiSecret)
                .withApiEndpoint(URI.create(apiEndpoint))
                .withIntegrator(merchantId)
                .withAuthorizationType(AuthorizationType.V1HMAC);
    }

    public ClientInterface createClient() {
        Connection connection = new DefaultConnectionBuilder(10000, 10000, 10000) // timeouts in ms
                .withMaxConnections(10)
                .withConnectionReuse(true)
                .build();

        Authenticator authenticator = new V1HmacAuthenticator(apiKey, apiSecret);

        MetadataProvider metadataProvider = new MetadataProviderBuilder(merchantId).build();

        ClientInterface client = Factory.createClient(
                URI.create(apiEndpoint),
                connection,
                authenticator,
                metadataProvider
        );

        client.closeIdleConnections(10, TimeUnit.MINUTES);

        return client;
    }

    @Bean
    public ClientInterface clientInterface() {
        return createClient();
    }
    @Bean
    public MerchantClient  merchantClient(ClientInterface client) {
        return (MerchantClient) client.merchant(merchantId);
    }
}