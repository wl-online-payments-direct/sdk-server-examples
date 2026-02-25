using DiscountSdk = OnlinePayments.Sdk.Domain.Discount;
using DiscountDto = Business.Domain.Payments.PaymentDetails.Discount;

namespace Infrastructure.Mappers.PaymentDetails;

public static class DiscountMapper
{
    public static DiscountDto Map(DiscountSdk? response)
    {
        return new()
        {
            Amount = response?.Amount
        };
    }
}