using  MobilePaymentMethodSpecificOutputDto = Business.Domain.Payments.PaymentDetails.MobilePaymentMethodSpecificOutput;
using  MobilePaymentMethodSpecificOutputSdk = OnlinePayments.Sdk.Domain. MobilePaymentMethodSpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class MobilePaymentMethodSpecificOutputMapper
{
    public static MobilePaymentMethodSpecificOutputDto Map( MobilePaymentMethodSpecificOutputSdk? response)
    {
        return new()
        {
            Network = response?.Network,
            AuthorisationCode = response?.AuthorisationCode,
            PaymentProductId = response?.PaymentProductId,
            FraudResults = CardFraudResultsMapper.Map(response?.FraudResults),
            PaymentData = MobilePaymentDataMapper.Map(response?.PaymentData),
            ThreeDSecureResults = ThreeDSecureResultsMapper.Map(response?.ThreeDSecureResults)
        };
    }
}