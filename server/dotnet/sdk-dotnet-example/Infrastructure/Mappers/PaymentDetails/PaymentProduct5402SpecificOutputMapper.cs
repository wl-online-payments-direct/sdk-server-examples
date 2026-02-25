using PaymentProduct5402SpecificOutputSdk = OnlinePayments.Sdk.Domain.PaymentProduct5402SpecificOutput;
using PaymentProduct5402SpecificOutputDto = Business.Domain.Payments.PaymentDetails.PaymentProduct5402SpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentProduct5402SpecificOutputMapper
{
    public static PaymentProduct5402SpecificOutputDto Map(PaymentProduct5402SpecificOutputSdk? response)
    {
        return new()
        {
            Brand = response?.Brand
        };
    }
}