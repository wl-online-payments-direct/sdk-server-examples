using Business.Domain.Enums.AdditionalPaymentActions;
using Business.DTOs.AdditionalPaymentActions;
using OnlinePayments.Sdk.Domain;

namespace Infrastructure.Mappers.AdditionalPaymentActions;

public static class CapturePaymentMapper
{
    public static AdditionalPaymentActionResponseDto Map(CaptureResponse? response)
    {
        Enum.TryParse(response?.Status, out Status status);
        
        return new()
        {
          Status  = status,
          Id = response?.Id,
          StatusOutput = new()
          {
              StatusCode = response?.StatusOutput?.StatusCode
          }
        };
    }
    
    public static CapturePaymentRequest Map(AdditionalPaymentActionRequestDto? dto)
    {
        return new()
        {
            Amount = (long?)dto?.Amount,
            IsFinal = dto?.IsFinal
        };
    }
}