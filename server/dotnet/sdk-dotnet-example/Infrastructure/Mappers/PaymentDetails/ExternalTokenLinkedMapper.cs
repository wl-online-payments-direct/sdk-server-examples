using ExternalTokenLinkedSdk = OnlinePayments.Sdk.Domain.ExternalTokenLinked;
using ExternalTokenLinkedDto = Business.Domain.Payments.PaymentDetails.ExternalTokenLinked;

namespace Infrastructure.Mappers.PaymentDetails;

public static class ExternalTokenLinkedMapper
{
    public static ExternalTokenLinkedDto Map(ExternalTokenLinkedSdk? response)
    {
        return new()
        {
            ComputedToken = response?.ComputedToken,
            GeneratedToken = response?.GeneratedToken
        };
    }
}