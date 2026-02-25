using PaymentOutputSdk = OnlinePayments.Sdk.Domain.PaymentOutput;
using PaymentOutputDto = Business.Domain.Payments.PaymentDetails.PaymentOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentOutputMapper
{
    public static PaymentOutputDto Map(PaymentOutputSdk? response)
    {
        return new()
        {
            Discount = DiscountMapper.Map(response?.Discount),
            AmountOfMoney = AmountOfMoneyMapper.Map(response?.AmountOfMoney),
            Customer = CustomerOutputMapper.Map(response?.Customer),
            PaymentMethod = response?.PaymentMethod,
            MerchantParameters = response?.MerchantParameters,
            AcquiredAmount = AmountOfMoneyMapper.Map(response?.AcquiredAmount),
            References = PaymentReferencesMapper.Map(response?.References),
            SurchargeSpecificOutput = SurchargeSpecificOutputMapper.Map(response?.SurchargeSpecificOutput),
            CardPaymentMethodSpecificOutput = CardPaymentMethodSpecificOutputMapper.Map(response?.CardPaymentMethodSpecificOutput),
            MobilePaymentMethodSpecificOutput = MobilePaymentMethodSpecificOutputMapper.Map(response?.MobilePaymentMethodSpecificOutput),
            RedirectPaymentMethodSpecificOutput = RedirectPaymentMethodSpecificOutputMapper.Map(response?.RedirectPaymentMethodSpecificOutput),
            SepaDirectDebitPaymentMethodSpecificOutput = SepaDirectDebitPaymentMethodSpecificOutputMapper.Map(response?.SepaDirectDebitPaymentMethodSpecificOutput)
        };
    }
}