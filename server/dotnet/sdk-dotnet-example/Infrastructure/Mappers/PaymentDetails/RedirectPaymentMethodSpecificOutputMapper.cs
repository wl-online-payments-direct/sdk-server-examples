using RedirectPaymentMethodSpecificOutputDto =
    Business.Domain.Payments.PaymentDetails.RedirectPaymentMethodSpecificOutput;
using RedirectPaymentMethodSpecificOutputSdk = OnlinePayments.Sdk.Domain.RedirectPaymentMethodSpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class RedirectPaymentMethodSpecificOutputMapper
{
    public static RedirectPaymentMethodSpecificOutputDto Map(RedirectPaymentMethodSpecificOutputSdk? response)
    {
        return new()
        {
            Token = response?.Token,
            AuthorisationCode = response?.AuthorisationCode,
            PaymentProductId = response?.PaymentProductId,
            PaymentOption = response?.PaymentOption,
            FraudResults = FraudResultsMapper.Map(response?.FraudResults),
            CustomerBankAccount = CustomerBankAccountMapper.Map(response?.CustomerBankAccount),
            PaymentProduct840SpecificOutput = PaymentProduct840SpecificOutputMapper.Map(response?.PaymentProduct840SpecificOutput),
            PaymentProduct3203SpecificOutput = PaymentProduct3203SpecificOutputMapper.Map(response?.PaymentProduct3203SpecificOutput),
            PaymentProduct5001SpecificOutput = PaymentProduct5001SpecificOutputMapper.Map(response?.PaymentProduct5001SpecificOutput),
            PaymentProduct5402SpecificOutput = PaymentProduct5402SpecificOutputMapper.Map(response?.PaymentProduct5402SpecificOutput),
            PaymentProduct5500SpecificOutput = PaymentProduct5500SpecificOutputMapper.Map(response?.PaymentProduct5500SpecificOutput)
        };
    }
}