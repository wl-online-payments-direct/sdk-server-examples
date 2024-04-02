using OnlinePayments.Sdk.Domain;
using OnlinePayments.Sdk.Merchant;

namespace OnlinePayments.Sdk.Example;

/// <summary>
/// Hosted checkout service used for hosted checkout scenarios
/// </summary>
public class HostedCheckoutService
{
    private readonly ILogger<HostedCheckoutService> _logger;

    private readonly IMerchantClient _merchantClient;

    public HostedCheckoutService(
        ILogger<HostedCheckoutService> logger,
        MerchantClientConfig merchantClientConfig
    )
    {
        _logger = logger;
        _merchantClient = merchantClientConfig.GetMerchantClient();
    }

    /// <summary>
    /// Creates a hosted checkout request by using the merchant client
    /// </summary>
    /// <param name="createHostedCheckoutRequest">Create hosted checkout request</param>
    /// <returns>Task of CreateHostedCheckoutResponse</returns>
    public async Task<CreateHostedCheckoutResponse> CreateHostedCheckoutResponse(CreateHostedCheckoutRequest createHostedCheckoutRequest) {
        _logger.LogInformation("Creating hosted checkout request for payment {} {}", createHostedCheckoutRequest.Order.AmountOfMoney.Amount, createHostedCheckoutRequest.Order.AmountOfMoney.CurrencyCode);
        var hostedCheckoutResponse = await _merchantClient.HostedCheckout.CreateHostedCheckout(createHostedCheckoutRequest);
        _logger.LogInformation("Successful hosted checkout - Return url: {}", hostedCheckoutResponse.RedirectUrl);
        return hostedCheckoutResponse;
    }
}
