using CardFraudResultsSdk = OnlinePayments.Sdk.Domain.CardFraudResults;
using CardFraudResultsDto = Business.Domain.Payments.PaymentDetails.CardFraudResults;

namespace Infrastructure.Mappers.PaymentDetails;

public static class CardFraudResultsMapper
{
    public static CardFraudResultsDto Map(CardFraudResultsSdk? response)
    {
        return new()
        {
            AvsResult = response?.AvsResult,
            FraudServiceResult = response?.FraudServiceResult,
            CvvResult = response?.CvvResult
        };
    }
}