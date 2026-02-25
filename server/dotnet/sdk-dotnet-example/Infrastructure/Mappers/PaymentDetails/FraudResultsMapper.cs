using FraudResultsDto = Business.Domain.Payments.PaymentDetails.FraudResults;
using FraudResultsSdk = OnlinePayments.Sdk.Domain.FraudResults;

namespace Infrastructure.Mappers.PaymentDetails;

public static class FraudResultsMapper
{
    public static FraudResultsDto Map(FraudResultsSdk? response)
    {
        return new()
        {
            FraudServiceResult = response?.FraudServiceResult
        };
    }
}