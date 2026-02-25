using ReattemptInstructionsSdk = OnlinePayments.Sdk.Domain.ReattemptInstructions;
using ReattemptInstructionsDto = Business.Domain.Payments.PaymentDetails.ReattemptInstructions;

namespace Infrastructure.Mappers.PaymentDetails;

public static class ReattemptInstructionsMapper
{
    public static ReattemptInstructionsDto Map(ReattemptInstructionsSdk? response)
    {
        return new()
        {
            Conditions = ReattemptInstructionsConditionsMapper.Map(response?.Conditions),
            FrozenPeriod = response?.FrozenPeriod,
            Indicator = response?.Indicator
        };
    }
}