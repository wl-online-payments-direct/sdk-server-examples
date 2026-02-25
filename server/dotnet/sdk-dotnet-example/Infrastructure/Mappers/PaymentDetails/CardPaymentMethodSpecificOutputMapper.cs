using CardPaymentMethodSpecificOutputSdk = OnlinePayments.Sdk.Domain.CardPaymentMethodSpecificOutput;
using CardPaymentMethodSpecificOutputDto = Business.Domain.Payments.PaymentDetails.CardPaymentMethodSpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class CardPaymentMethodSpecificOutputMapper
{
    public static CardPaymentMethodSpecificOutputDto Map(CardPaymentMethodSpecificOutputSdk? response)
    {
        return new()
        {
            Card = CardEssentialsMapper.Map(response?.Card),
            AcquirerInformation = AcquirerInformationMapper.Map(response?.AcquirerInformation),
            AuthorisationCode = response?.AuthorisationCode,
            CurrencyConversion = CurrencyConversionMapper.Map(response?.CurrencyConversion),
            AuthenticatedAmount = response?.AuthenticatedAmount,
            FraudResults = CardFraudResultsMapper.Map(response?.FraudResults),
            PaymentOption = response?.PaymentOption,
            ReattemptInstructions = ReattemptInstructionsMapper.Map(response?.ReattemptInstructions),
            ExternalTokenLinked = ExternalTokenLinkedMapper.Map(response?.ExternalTokenLinked),
            PaymentAccountReference = response?.PaymentAccountReference,
            PaymentProductId = response?.PaymentProductId,
            InitialSchemeTransactionId = response?.InitialSchemeTransactionId,
            SchemeReferenceData = response?.SchemeReferenceData,
            PaymentProduct3208SpecificOutput = PaymentProduct3208SpecificOutputMapper.Map(response?.PaymentProduct3208SpecificOutput),
            PaymentProduct3209SpecificOutput = PaymentProduct3209SpecificOutputMapper.Map(response?.PaymentProduct3209SpecificOutput),
            ThreeDSecureResults = ThreeDSecureResultsMapper.Map(response?.ThreeDSecureResults),
            Token = response?.Token
        };
    }
}