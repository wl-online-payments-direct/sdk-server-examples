using AmountOfMoneySdk = OnlinePayments.Sdk.Domain.AmountOfMoney;
using AmountOfMoneyDto = Business.Domain.Payments.PaymentDetails.AmountOfMoney;

namespace Infrastructure.Mappers.PaymentDetails;

public static class AmountOfMoneyMapper
{
    public static AmountOfMoneyDto Map(AmountOfMoneySdk? response)
    {
        return new()
        {
            Amount = response?.Amount,
            CurrencyCode = response?.CurrencyCode,
        };
    }
}