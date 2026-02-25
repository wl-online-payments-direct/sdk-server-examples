using PaymentProduct840SpecificOutputSdk = OnlinePayments.Sdk.Domain.PaymentProduct840SpecificOutput;
using PaymentProduct840SpecificOutputDto = Business.Domain.Payments.PaymentDetails.PaymentProduct840SpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentProduct840SpecificOutputMapper
{
    public static PaymentProduct840SpecificOutputDto Map(PaymentProduct840SpecificOutputSdk? response)
    {
        return new()
        {
            BillingAddress = AddressMapper.Map(response?.BillingAddress),
            CustomerAccount = PaymentProduct840CustomerAccountMapper.Map(response?.CustomerAccount),
            CustomerAddress = AddressMapper.Map(response?.CustomerAddress),
            ProtectionEligibility = ProtectionEligibilityMapper.Map(response?.ProtectionEligibility)
        };
    }
}