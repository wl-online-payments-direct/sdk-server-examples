using SurchargeSpecificOutputSdk = OnlinePayments.Sdk.Domain.SurchargeSpecificOutput;
using SurchargeSpecificOutputDto = Business.Domain.Payments.PaymentDetails.SurchargeSpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class SurchargeSpecificOutputMapper
{
    public static SurchargeSpecificOutputDto Map(SurchargeSpecificOutputSdk? response)
    {
        return new()
        {
            SurchargeRate = SurchargeRateMapper.Map(response?.SurchargeRate),
            SurchargeAmount = AmountOfMoneyMapper.Map(response?.SurchargeAmount),
            Mode = response?.Mode
        };
    }
}