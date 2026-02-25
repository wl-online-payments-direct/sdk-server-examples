using MobilePaymentDataDto = Business.Domain.Payments.PaymentDetails.MobilePaymentData;
using MobilePaymentDataSdk = OnlinePayments.Sdk.Domain.MobilePaymentData;

namespace Infrastructure.Mappers.PaymentDetails;

public static class MobilePaymentDataMapper
{
    public static MobilePaymentDataDto Map(MobilePaymentDataSdk? response)
    {
        return new()
        {
            Dpan = response?.Dpan,
            ExpiryDate = response?.ExpiryDate
        };
    }
}