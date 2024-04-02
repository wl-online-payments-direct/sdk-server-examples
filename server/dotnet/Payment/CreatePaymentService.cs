using OnlinePayments.Sdk.Domain;
using OnlinePayments.Sdk.Merchant;

namespace OnlinePayments.Sdk.Example;

/// <summary>
/// Create payment service used for create payment scenarios
/// </summary>
public class CreatePaymentService
{
    private readonly ILogger<CreatePaymentService> _logger;
    private readonly IMerchantClient _merchantClient;

    public CreatePaymentService(
        ILogger<CreatePaymentService> logger,
        MerchantClientConfig merchantClientConfig
    )
    {
        _logger = logger;
        _merchantClient = merchantClientConfig.GetMerchantClient();
    }

    /// <summary>
    /// Creates a payment request for hosted tokenization scenario
    /// </summary>
    /// <param name="createPaymentRequest">Create payment request</param>
    /// <returns>Task of CreatePaymentResponse</returns>
    public async Task<CreatePaymentResponse> CreateHostedTokenizationPayment(CreatePaymentRequest createPaymentRequest) {
        _logger.LogInformation("Creating hosted checkout request for payment {} {} and hosted tokenization id {}",
            createPaymentRequest.Order.AmountOfMoney.Amount,
            createPaymentRequest.Order.AmountOfMoney.CurrencyCode,
            createPaymentRequest.HostedTokenizationId
        );
        var paymentResponse = await _merchantClient.Payments.CreatePayment(createPaymentRequest);
        _logger.LogInformation("Successful payment with payment id {}", paymentResponse.Payment.Id);
        return  paymentResponse;

    }

    /// <summary>
    /// Creates a payment for payment scenario (Basic, 3DS ...)
    /// </summary>
    /// <param name="createPaymentRequest">Create payment request</param>
    /// <returns>Task of Create payment response</returns>
    public async Task<CreatePaymentResponse> CreatePayment(CreatePaymentRequest createPaymentRequest) {
        _logger.LogInformation("Creating payment request {} {}",
            createPaymentRequest.Order.AmountOfMoney.Amount,
            createPaymentRequest.Order.AmountOfMoney.CurrencyCode
        );
        var paymentResponse = await _merchantClient.Payments.CreatePayment(createPaymentRequest);
        _logger.LogInformation("Successful payment with payment id {}", paymentResponse.Payment.Id);
        return  paymentResponse;

    }
}
