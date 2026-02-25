using CardEssentialsSdk = OnlinePayments.Sdk.Domain.CardEssentials;
using CardEssentialsDto = Business.Domain.Payments.PaymentDetails.CardEssentials;

namespace Infrastructure.Mappers.PaymentDetails;

public static class CardEssentialsMapper
{
    public static CardEssentialsDto Map(CardEssentialsSdk? response)
    {
        return new()
        {
            CountryCode = response?.CountryCode,
            CardNumber =  response?.CardNumber,
            ExpiryDate = response?.ExpiryDate,
            Bin = response?.Bin
        };
    }
}