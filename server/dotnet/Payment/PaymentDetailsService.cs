using OnlinePayments.Sdk.Domain;
using OnlinePayments.Sdk.Merchant;

namespace OnlinePayments.Sdk.Example;

/// <summary>
/// Payment details service used for fetching payment details
/// </summary>
public class PaymentDetailsService
{
    private readonly IMerchantClient _merchantClient;

    public PaymentDetailsService(
        MerchantClientConfig merchantClientConfig
    )
    {
        _merchantClient = merchantClientConfig.GetMerchantClient();
    }

    /// <summary>
    /// Get payment details for a hosted checkout id
    /// </summary>
    /// <param name="hostedCheckoutId">Hosted checkout id</param>
    /// <returns>Payment details</returns>
    public async Task<PaymentDetailsResponse> GetPaymentDetailsForHostedCheckout(string hostedCheckoutId) {
        string paymentId = string.Format("{0}_0", hostedCheckoutId);
        return await _merchantClient.Payments.GetPaymentDetails(paymentId);
    }

    /// <summary>
    /// Get payment details for a payment id
    /// </summary>
    /// <param name="paymentId">Payment id</param>
    /// <returns>Payment details</returns>
    public async Task<PaymentDetailsResponse> GetPaymentDetails(string paymentId) {
        return await _merchantClient.Payments.GetPaymentDetails(paymentId);
    }
}
