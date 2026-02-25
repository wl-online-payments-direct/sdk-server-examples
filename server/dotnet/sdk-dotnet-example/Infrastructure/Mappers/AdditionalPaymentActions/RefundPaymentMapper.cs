using Business.Domain.Common.Enums;
using Business.Domain.Enums.AdditionalPaymentActions;
using Business.DTOs.AdditionalPaymentActions;
using OnlinePayments.Sdk.Domain;

namespace Infrastructure.Mappers.AdditionalPaymentActions;

public static class RefundPaymentMapper
{
    public static AdditionalPaymentActionResponseDto Map(RefundResponse? response)
    {
        Enum.TryParse(response?.Status, out Status status);
        Enum.TryParse(response?.StatusOutput?.StatusCategory, out StatusCategory statusCategory);
        
        return new()
        {
            Id = response?.Id,
            Status = status,
            StatusOutput = new()
            {
                StatusCode = response?.StatusOutput?.StatusCode,
                StatusCategory = statusCategory 
            }
        };
    }
    
    public static RefundRequest Map(AdditionalPaymentActionRequestDto? dto)
    {
        return new()
        {
            AmountOfMoney = new()
            {
                Amount = (long?)dto?.Amount,
                CurrencyCode = dto?.Currency.ToString()
            }
        };
    }
}