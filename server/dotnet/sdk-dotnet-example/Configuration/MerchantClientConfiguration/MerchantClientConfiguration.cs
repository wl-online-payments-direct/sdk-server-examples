using Configuration.Exceptions;
using OnlinePayments.Sdk;
using OnlinePayments.Sdk.Authentication;
using OnlinePayments.Sdk.Communication;
using OnlinePayments.Sdk.Merchant;
using Microsoft.Extensions.Options;
using Microsoft.Extensions.Logging;

namespace Configuration.MerchantClientConfiguration;

public class MerchantClientConfiguration
{
    private readonly ILogger<MerchantClientConfiguration> logger;

    private readonly AppSettings.AppSettings appSettings;
    private readonly IClient client;
    private readonly IMerchantClient merchantClient;

    public MerchantClientConfiguration(
        ILogger<MerchantClientConfiguration> logger,
        IOptions<AppSettings.AppSettings> appSettings
    )
    {
        this.logger = logger;
        this.appSettings = appSettings.Value;
        client = SetupClient(SetupCommunicatorConfiguration());
        merchantClient = SetupMerchantClient(client);
    }

    public IMerchantClient GetMerchantClient()
    {
        return merchantClient;
    }

    private IClient SetupClient(CommunicatorConfiguration communicatorConfiguration)
    {
        try
        {
            if (appSettings.UseCommunicatorConfiguration)
            {
                return CreateClientFromCommunicator(communicatorConfiguration);
            }

            return CreateClient();
        }
        catch (Exception e)
        {
            logger.LogError(e, "An error has occurred during client setup.");
            
            throw new ConfigurationException("An error has occurred during client setup.");
        }
    }

    private IClient CreateClientFromCommunicator(CommunicatorConfiguration communicatorConfiguration)
    {
        IClient newClient = Factory.CreateClient(communicatorConfiguration);
        newClient.CloseIdleConnections(TimeSpan.FromMinutes(10));

        return newClient;
    }

    private IClient CreateClient()
    {
        IConnection connection = new DefaultConnection(TimeSpan.FromSeconds(10000));
        IAuthenticator authenticator =
            new V1HmacAuthenticator(AuthorizationType.V1HMAC, appSettings.ApiKey, appSettings.ApiSecret);
        IMetadataProvider metadataProvider = new MetadataProvider(new MetadataProviderBuilder(appSettings.MerchantId));
        
        Uri apiEndpoint = new Uri(appSettings.ApiEndpoint);
        IClient newClient = Factory.CreateClient(apiEndpoint, connection, authenticator, metadataProvider);
        
        newClient.CloseIdleConnections(TimeSpan.FromMinutes(10));

        return newClient;
    }

    private IMerchantClient SetupMerchantClient(IClient setupClient)
    {
        return setupClient.WithNewMerchant(appSettings.MerchantId);
    }

    private CommunicatorConfiguration SetupCommunicatorConfiguration()
    {
        try
        {
            return new CommunicatorConfiguration
            {
                ApiKeyId = appSettings.ApiKey,
                SecretApiKey = appSettings.ApiSecret,
                ApiEndpoint = new Uri(appSettings.ApiEndpoint),
                Integrator = appSettings.MerchantId,
                AuthorizationType = AuthorizationType.V1HMAC
            };
        }
        catch (Exception ex)
        {
            logger.LogError(ex,
                "An error has occurred during communicator configuration setup. Please check provided credentials.");
            
            throw new ConfigurationException(
                "An error has occurred during communicator configuration setup. Please check provided credentials.");
        }
    }
}