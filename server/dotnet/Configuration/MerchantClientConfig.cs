using Microsoft.Extensions.Options;
using OnlinePayments.Sdk;
using OnlinePayments.Sdk.DefaultImpl;
using OnlinePayments.Sdk.Merchant;

namespace OnlinePayments.Sdk.Example;

/// <summary>
/// Configuration class for clients
/// </summary>
public class MerchantClientConfig
{
    private readonly ILogger<MerchantClientConfig> _logger;

    private readonly AppSettings _appSettings;
    private readonly IClient _client;
    private readonly IMerchantClient _merchantClient;

    private readonly CommunicatorConfiguration _communicatorConfiguration;

    public MerchantClientConfig(
        ILogger<MerchantClientConfig> logger,
        IOptions<AppSettings> appSettings
    )
    {
        _logger = logger;
        _appSettings = appSettings.Value;
        _communicatorConfiguration = SetupCommuniatorConfiguration();
        _client = SetupClient(_communicatorConfiguration);
        _merchantClient = SetupMerchantClient(_client);
    }

    /// <summary>
    /// Setup a client based on apikey, apisecret and merchantId
    /// </summary>
    /// <returns>IClient instance</returns>
    private IClient SetupClient(CommunicatorConfiguration communicatorConfiguration)
    {
        try
        {
            if (_appSettings.UseCommunicatorConfiguration) {
                return CreateClientFromCommunicator(communicatorConfiguration);
            } else {
                return CreateClient();
            }
        }
        catch (Exception e)
        {
            _logger.LogError("An error has occurred durring client setup", e);
            throw;
        }
    }

    /// <summary>
    /// Creates a client from communicator configuration
    /// </summary>
    /// <param name="communicatorConfiguration">Provided communicator configuration</param>
    /// <returns>Instance of IClient</returns>
    private IClient CreateClientFromCommunicator(CommunicatorConfiguration communicatorConfiguration)
    {
        IClient client = Factory.CreateClient(communicatorConfiguration);

        // even though the IClientInterface extends the java.io.Closable interface
        // it is a good practice to close idle connections (in this case 10 mins)
        client.CloseIdleConnections(TimeSpan.FromMinutes(10));

        return client;
    }

    /// <summary>
    /// Creates a basic client
    /// </summary>
    /// <returns>Instance of IClient</returns>
    private IClient CreateClient()
    {
        Uri apiEndpoint = new Uri(_appSettings.ApiEndpoint);

        IClient client = Factory.CreateClient(_appSettings.ApiKey, _appSettings.ApiSecret, apiEndpoint, _appSettings.MerchantId);

        // even though the IClientInterface extends the java.io.Closable interface
        // it is a good practice to close idle connections (in this case 10 mins)
        client.CloseIdleConnections(TimeSpan.FromMinutes(10));

        return client;
    }

    /// <summary>
    /// Setup a merchant client based on the already created client instance
    /// </summary>
    /// <returns></returns>
    private IMerchantClient SetupMerchantClient(IClient client) {
        return client.WithNewMerchant(_appSettings.MerchantId);
    }

    /// <summary>
    /// Creates a communicator configuration
    /// </summary>
    /// <returns></returns>
    private CommunicatorConfiguration SetupCommuniatorConfiguration() {
        return new CommunicatorConfiguration() {
            ApiKeyId = _appSettings.ApiKey,
            SecretApiKey = _appSettings.ApiSecret,
            ApiEndpoint = new Uri(_appSettings.ApiEndpoint),
            Integrator = _appSettings.MerchantId,
            AuthorizationType = AuthorizationType.V1HMAC
        };
    }

    #region Getters
    public IClient GetClient() {
        return _client;
    }

    public IMerchantClient GetMerchantClient() {
        return _merchantClient;
    }
    #endregion

}
