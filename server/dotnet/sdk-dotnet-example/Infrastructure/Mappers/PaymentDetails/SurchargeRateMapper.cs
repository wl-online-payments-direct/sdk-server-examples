using SurchargeRateSdk = OnlinePayments.Sdk.Domain.SurchargeRate;
using SurchargeRateDto = Business.Domain.Payments.PaymentDetails.SurchargeRate;

namespace Infrastructure.Mappers.PaymentDetails;

public static class SurchargeRateMapper
{
    public static SurchargeRateDto Map(SurchargeRateSdk? response)
    {
        return new()
        {
            SpecificRate = response?.SpecificRate,
            AdValoremRate = response?.AdValoremRate,
            SurchargeProductTypeVersion = response?.SurchargeProductTypeVersion,
            SurchargeProductTypeId = response?.SurchargeProductTypeId,
        };
    }
}