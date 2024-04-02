using OnlinePayments.Sdk.Domain;
using OnlinePayments.Sdk.Merchant;

namespace OnlinePayments.Sdk.Example;

public class HostedTokenizationService
{
    private readonly ILogger<HostedTokenizationService> _logger;

    private readonly IMerchantClient _merchantClient;

    public HostedTokenizationService(
        ILogger<HostedTokenizationService> logger,
        MerchantClientConfig merchantClientConfig
    )
    {
        _logger = logger;
        _merchantClient = merchantClientConfig.GetMerchantClient();
    }

    /// <summary>
    /// Initialize hosted tokenization
    /// </summary>
    /// <returns>Hosted tokenization response</returns>
    public async Task<CreateHostedTokenizationResponse> InitHostedTokenization() {
        _logger.LogInformation("Initializing hosted tokenization ...");
        var hostedTokenizationResponse = await _merchantClient.HostedTokenization.CreateHostedTokenization(new CreateHostedTokenizationRequest());
        _logger.LogInformation("Successful initialization for hosted tokenization - Hosted Tokenization Url: {}", hostedTokenizationResponse.HostedTokenizationUrl);
        return hostedTokenizationResponse;
    }
}
