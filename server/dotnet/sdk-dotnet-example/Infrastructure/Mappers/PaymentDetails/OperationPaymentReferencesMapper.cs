using OperationPaymentReferencesSdk = OnlinePayments.Sdk.Domain.OperationPaymentReferences;
using OperationPaymentReferencesDto = Business.Domain.Payments.PaymentDetails.OperationPaymentReferences;

namespace Infrastructure.Mappers.PaymentDetails;

public static class OperationPaymentReferencesMapper
{
    public static OperationPaymentReferencesDto Map(OperationPaymentReferencesSdk? response)
    {
        return new()
        {
            MerchantReference = response?.MerchantReference
        };
    }
}