using APIErrorSdk = OnlinePayments.Sdk.Domain.APIError;
using APIErrorDto = Business.Domain.Payments.PaymentDetails.APIError;

namespace Infrastructure.Mappers.PaymentDetails;

public static class ApiErrorMapper
{
    public static APIErrorDto Map(APIErrorSdk? response)
    {
        return new()
        {
            Message = response?.Message,
            ErrorCode = response?.ErrorCode,
            PropertyName = response?.PropertyName,
            HttpStatusCode = response?.HttpStatusCode,
            Retriable = response?.Retriable,
            Category = response?.Category,
            Id = response?.Id,
        };
    }
}