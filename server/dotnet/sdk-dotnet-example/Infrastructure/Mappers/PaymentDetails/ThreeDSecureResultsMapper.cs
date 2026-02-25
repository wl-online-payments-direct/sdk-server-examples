using ThreeDSecureResultsSdk = OnlinePayments.Sdk.Domain.ThreeDSecureResults;
using ThreeDSecureResultsDto = Business.Domain.Payments.PaymentDetails.ThreeDSecureResults;

namespace Infrastructure.Mappers.PaymentDetails;

public static class ThreeDSecureResultsMapper
{
    public static ThreeDSecureResultsDto Map(ThreeDSecureResultsSdk? response)
    {
        return new()
        {
            Cavv = response?.Cavv,
            AppliedExemption = response?.AppliedExemption,
            AuthenticationStatus = response?.AuthenticationStatus,
            ChallengeIndicator = response?.ChallengeIndicator,
            SchemeEci = response?.SchemeEci,
            AcsTransactionId = response?.AcsTransactionId,
            DsTransactionId = response?.DsTransactionId,
            ExemptionEngineFlow = response?.ExemptionEngineFlow,
            Liability = response?.Liability,
            Eci = response?.Eci,
            Flow = response?.Flow,
            Version = response?.Version,
            Xid = response?.Xid
        };
    }
}