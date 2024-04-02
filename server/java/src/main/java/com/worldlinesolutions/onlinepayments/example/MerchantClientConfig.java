package com.worldlinesolutions.onlinepayments.example;

import com.onlinepayments.ClientInterface;
import com.onlinepayments.CommunicatorConfiguration;
import com.onlinepayments.Factory;
import com.onlinepayments.defaultimpl.AuthorizationType;
import com.onlinepayments.merchant.MerchantClientInterface;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

import java.net.URI;
import java.net.URISyntaxException;
import java.util.concurrent.TimeUnit;

/**
 * Configuration class for clients
 */
@Configuration
public class MerchantClientConfig {

    private static Logger log = LoggerFactory.getLogger(MerchantClientConfig.class);

    private static final String INTEGRATOR = "integrator";

    @Value("${merchantId}")
    private String merchantId;

    @Value("${apiKey}")
    private String apiKey;

    @Value("${apiSecret}")
    private String apiSecret;

    @Value("${apiEndpoint}")
    private String apiEndpoint;

    /**
     * Bean for {@link ClientInterface} generated based on the paymentprovider.properties file
     * @return Instance of {@link ClientInterface}
     */
    @Bean
    public ClientInterface client() {
        try {
            URI propertiesUri = getClass().getClassLoader().getResource("paymentprovider.properties").toURI();
            ClientInterface client = Factory.createClient(propertiesUri, apiKey, apiSecret);

            // even though the IClientInterface extends the java.io.Closable interface
            // it is a good practice to close idle connections (in this case 10 mins)
            client.closeIdleConnections(10, TimeUnit.MINUTES);

            return  client;
        } catch (URISyntaxException ex) {
            log.error("Invalid URI syntax!", ex);
            return null;
        }
    }

    /**
     * Bean for {@link MerchantClientInterface} generated based on the {@link this#client()}
     * @param client Client instance used for the generation
     * @return Instance of {@link MerchantClientInterface}
     */
    @Bean
    public MerchantClientInterface merchantClient(ClientInterface client) {
        return client.merchant(merchantId);
    }

    /**
     * Bean for {@link CommunicatorConfiguration} used for setting up a Client and MerchantClient for the SDK
     * @return Instance of {@link CommunicatorConfiguration}
     */
    @Bean
    public CommunicatorConfiguration communicatorConfiguration() {
        return new CommunicatorConfiguration()
                .withApiKeyId(apiKey)
                .withSecretApiKey(apiSecret)
                .withApiEndpoint(URI.create(apiEndpoint))
                .withIntegrator(INTEGRATOR)
                .withAuthorizationType(AuthorizationType.V1HMAC);
    }

    /**
     * Bean for {@link ClientInterface} generated based on the {@link this#communicatorConfiguration()}
     * @return Instance of {@link ClientInterface}
     */
    @Bean
    public ClientInterface clientFromCommunicator(CommunicatorConfiguration communicatorConfiguration) {
        ClientInterface client = Factory.createClient(communicatorConfiguration);

        // even though the IClientInterface extends the java.io.Closable interface
        // it is a good practice to close idle connections (in this case 10 mins)
        client.closeIdleConnections(10, TimeUnit.MINUTES);

        return client;
    }

    /**
     * Bean for {@link MerchantClientInterface} generated based on the {@link this#clientFromCommunicator(CommunicatorConfiguration)} ()}
     * @param clientFromCommunicator Client instance used for the generation
     * @return Instance of {@link MerchantClientInterface}
     */
    @Bean
    public MerchantClientInterface merchantClientFromCommunicator(ClientInterface clientFromCommunicator) {
        return clientFromCommunicator.merchant(merchantId);
    }

}
