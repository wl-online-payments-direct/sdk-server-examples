using RateDetailsSdk = OnlinePayments.Sdk.Domain.RateDetails;
using RateDetailsDto = Business.Domain.Payments.PaymentDetails.RateDetails;

namespace Infrastructure.Mappers.PaymentDetails;

public static class RateDetailsMapper
{
    public static RateDetailsDto Map(RateDetailsSdk? response)
    {
        return new()
        {
            Source = response?.Source,
            ExchangeRate = response?.ExchangeRate,
            InvertedExchangeRate = response?.InvertedExchangeRate,
            MarkUpRate = response?.MarkUpRate,
            QuotationDateTime = response?.QuotationDateTime
        };
    }
}