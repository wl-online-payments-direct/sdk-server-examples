using PaymentProduct3209SpecificOutputSdk = OnlinePayments.Sdk.Domain.PaymentProduct3209SpecificOutput;
using PaymentProduct3209SpecificOutputDto = Business.Domain.Payments.PaymentDetails.PaymentProduct3209SpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentProduct3209SpecificOutputMapper
{
    public static PaymentProduct3209SpecificOutputDto Map(PaymentProduct3209SpecificOutputSdk? response)
    {
        return new()
        {
            BuyerCompliantBankMessage = response?.BuyerCompliantBankMessage
        };
    }
}