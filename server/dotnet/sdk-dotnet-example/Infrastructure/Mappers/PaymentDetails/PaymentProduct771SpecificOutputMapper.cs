using PaymentProduct771SpecificOutputSdk = OnlinePayments.Sdk.Domain.PaymentProduct771SpecificOutput;
using PaymentProduct771SpecificOutputDto = Business.Domain.Payments.PaymentDetails.PaymentProduct771SpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentProduct771SpecificOutputMapper
{
    public static PaymentProduct771SpecificOutputDto Map(PaymentProduct771SpecificOutputSdk? response)
    {
        return new()
        {
            MandateReference = response?.MandateReference
        };
    }
}