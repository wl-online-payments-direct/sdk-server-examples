using APIErrorSdk = OnlinePayments.Sdk.Domain.APIError;
using APIErrorDto = Business.Domain.Payments.PaymentDetails.APIError;
using PaymentStatusOutputSdk = OnlinePayments.Sdk.Domain.PaymentStatusOutput;
using PaymentStatusOutputDto = Business.Domain.Payments.PaymentDetails.PaymentStatusOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentStatusOutputMapper
{
    public static PaymentStatusOutputDto Map(PaymentStatusOutputSdk? response)
    {
        return new()
        {
            IsAuthorized = response?.IsAuthorized,
            IsCancellable = response?.IsCancellable,
            IsRefundable = response?.IsRefundable,
            StatusCategory = response?.StatusCategory,
            StatusCode = response?.StatusCode,
            StatusCodeChangeDateTime = response?.StatusCodeChangeDateTime,
            Errors = MapList(response?.Errors)
        };
    }
    
    private static IList<APIErrorDto>? MapList( IList<APIErrorSdk>? errors)
    {
        return errors?.ToList().Select(ApiErrorMapper.Map).ToList();
    }
}