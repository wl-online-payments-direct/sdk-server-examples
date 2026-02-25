using PaymentReferencesSdk = OnlinePayments.Sdk.Domain.PaymentReferences;
using PaymentReferencesDto = Business.Domain.Payments.PaymentDetails.PaymentReferences;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentReferencesMapper
{
    public static PaymentReferencesDto Map(PaymentReferencesSdk? response)
    {
        return new()
        {
            MerchantParameters = response?.MerchantParameters,
            MerchantReference = response?.MerchantReference
        };
    }
}