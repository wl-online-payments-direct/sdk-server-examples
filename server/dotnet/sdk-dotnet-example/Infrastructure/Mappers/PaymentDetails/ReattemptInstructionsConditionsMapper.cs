using ReattemptInstructionsConditionsSdk = OnlinePayments.Sdk.Domain.ReattemptInstructionsConditions;
using ReattemptInstructionsConditionsDto = Business.Domain.Payments.PaymentDetails.ReattemptInstructionsConditions;

namespace Infrastructure.Mappers.PaymentDetails;

public static class ReattemptInstructionsConditionsMapper
{
    public static ReattemptInstructionsConditionsDto Map(ReattemptInstructionsConditionsSdk? response)
    {
        return new()
        {
            MaxAttempts = response?.MaxAttempts,
            MaxDelay = response?.MaxDelay
        };
    }
}