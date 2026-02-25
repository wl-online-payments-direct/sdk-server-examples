using ProtectionEligibilitySdk = OnlinePayments.Sdk.Domain.ProtectionEligibility;
using ProtectionEligibilityDto = Business.Domain.Payments.PaymentDetails.ProtectionEligibility;

namespace Infrastructure.Mappers.PaymentDetails;

public static class ProtectionEligibilityMapper
{
    public static ProtectionEligibilityDto Map(ProtectionEligibilitySdk? response)
    {
        return new()
        {
            Eligibility = response?.Eligibility,
            Type = response?.Type
        };
    }
}