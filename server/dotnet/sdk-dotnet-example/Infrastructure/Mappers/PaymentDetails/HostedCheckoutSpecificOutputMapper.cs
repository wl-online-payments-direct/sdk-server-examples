using HostedCheckoutSpecificOutputSdk = OnlinePayments.Sdk.Domain.HostedCheckoutSpecificOutput;
using HostedCheckoutSpecificOutputDto = Business.Domain.Payments.PaymentDetails.HostedCheckoutSpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class HostedCheckoutSpecificOutputMapper
{
    public static HostedCheckoutSpecificOutputDto Map(HostedCheckoutSpecificOutputSdk? response)
    {
        return new()
        {
            Variant = response?.Variant,
            HostedCheckoutId = response?.HostedCheckoutId
        };
    }
}