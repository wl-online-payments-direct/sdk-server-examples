using PaymentProduct5001SpecificOutputSdk = OnlinePayments.Sdk.Domain.PaymentProduct5001SpecificOutput;
using PaymentProduct5001SpecificOutputDto = Business.Domain.Payments.PaymentDetails.PaymentProduct5001SpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentProduct5001SpecificOutputMapper
{
    public static PaymentProduct5001SpecificOutputDto Map(PaymentProduct5001SpecificOutputSdk? response)
    {
        return new()
        {
            Liability = response?.Liability,
            AccountNumber = response?.AccountNumber,
            AuthorisationCode = response?.AuthorisationCode,
            OperationCode = response?.OperationCode,
            MobilePhoneNumber = response?.MobilePhoneNumber
        };
    }
}