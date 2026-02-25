using Business.Exceptions;
using OnlinePayments.Sdk;
using OnlinePayments.Sdk.Domain;

namespace Infrastructure.Mappers.Exceptions;

public static class ExceptionMapper
{
    public static SdkException Map(ApiException apiException, string? message = null)
    {
        APIError? apiError = apiException.Errors.FirstOrDefault();
        string errorMessage = !string.IsNullOrWhiteSpace(message)
                ? message
                : !string.IsNullOrWhiteSpace(apiError?.Id)
                    ? apiError.Id
                    : !string.IsNullOrWhiteSpace(apiError?.Message)
                        ? apiError.Message
                        : $"{apiError?.Category ?? "UNKNOWN"} ({apiError?.ErrorCode ?? "UNKNOWN"})";
        
        return new SdkException(errorMessage, apiException.StatusCode);
    }
}