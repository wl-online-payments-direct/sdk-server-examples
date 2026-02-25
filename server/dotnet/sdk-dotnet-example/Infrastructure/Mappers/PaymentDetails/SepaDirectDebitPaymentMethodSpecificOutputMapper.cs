using SepaDirectDebitPaymentMethodSpecificOutputSdk = OnlinePayments.Sdk.Domain.SepaDirectDebitPaymentMethodSpecificOutput;
using SepaDirectDebitPaymentMethodSpecificOutputDto = Business.Domain.Payments.PaymentDetails.SepaDirectDebitPaymentMethodSpecificOutput;


namespace Infrastructure.Mappers.PaymentDetails;

public static class SepaDirectDebitPaymentMethodSpecificOutputMapper
{
    public static SepaDirectDebitPaymentMethodSpecificOutputDto Map( SepaDirectDebitPaymentMethodSpecificOutputSdk? response)
    {
        return new()
        {
            PaymentProductId = response?.PaymentProductId,
            FraudResults = FraudResultsMapper.Map(response?.FraudResults),
            PaymentProduct771SpecificOutput = PaymentProduct771SpecificOutputMapper.Map(response?.PaymentProduct771SpecificOutput)
        };
    }
}