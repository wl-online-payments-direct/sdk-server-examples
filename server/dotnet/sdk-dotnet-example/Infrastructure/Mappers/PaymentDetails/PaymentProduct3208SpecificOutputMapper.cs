using PaymentProduct3208SpecificOutputSdk = OnlinePayments.Sdk.Domain.PaymentProduct3208SpecificOutput;
using PaymentProduct3208SpecificOutputDto = Business.Domain.Payments.PaymentDetails.PaymentProduct3208SpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentProduct3208SpecificOutputMapper
{
    public static PaymentProduct3208SpecificOutputDto Map(PaymentProduct3208SpecificOutputSdk? response)
    {
        return new()
        {
            BuyerCompliantBankMessage = response?.BuyerCompliantBankMessage
        };
    }
}