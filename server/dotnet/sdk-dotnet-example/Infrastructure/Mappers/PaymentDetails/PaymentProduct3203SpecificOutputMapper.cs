using PaymentProduct3203SpecificOutputSdk = OnlinePayments.Sdk.Domain.PaymentProduct3203SpecificOutput;
using PaymentProduct3203SpecificOutputDto = Business.Domain.Payments.PaymentDetails.PaymentProduct3203SpecificOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentProduct3203SpecificOutputMapper
{
    public static PaymentProduct3203SpecificOutputDto Map(PaymentProduct3203SpecificOutputSdk? response)
    {
        return new()
        {
            BillingAddress = AddressPersonalMapper.Map(response?.BillingAddress),
            ShippingAddress = AddressPersonalMapper.Map(response?.ShippingAddress)
        };
    }
}