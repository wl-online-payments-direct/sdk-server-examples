using PaymentProduct5500SpecificOutputSdk = OnlinePayments.Sdk.Domain.PaymentProduct5500SpecificOutput;
using PaymentProduct5500SpecificOutputDto = Business.Domain.Payments.PaymentDetails.PaymentProduct5500SpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentProduct5500SpecificOutputMapper
{
    public static PaymentProduct5500SpecificOutputDto Map(PaymentProduct5500SpecificOutputSdk? response)
    {
        return new()
        {
            PaymentReference = response?.PaymentReference,
            PaymentEndDate = response?.PaymentEndDate,
            PaymentStartDate = response?.PaymentStartDate,
            EntityId = response?.EntityId
        };
    }
}