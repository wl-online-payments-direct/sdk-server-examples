using Business.Domain.Common.Enums;
using Business.Domain.Enums.AdditionalPaymentActions;
using Business.DTOs.AdditionalPaymentActions;
using OnlinePayments.Sdk.Domain;

namespace Infrastructure.Mappers.AdditionalPaymentActions;

public static class CancelPaymentMapper
{
    public static AdditionalPaymentActionResponseDto Map(CancelPaymentResponse? response)
    {
        Enum.TryParse(response?.Payment?.Status, out Status status);
        Enum.TryParse(response?.Payment?.StatusOutput?.StatusCategory, out StatusCategory statusCategory);
        
        return new()
        {
            Id = response?.Payment?.Id,
            Status = status,
            StatusOutput = new()
            {
                StatusCode = response?.Payment?.StatusOutput?.StatusCode,
                StatusCategory = statusCategory,
            }
        };
    }
    
    public static CancelPaymentRequest Map(AdditionalPaymentActionRequestDto? requestDto)
    {
        return new()
        {
            AmountOfMoney = new()
            {
                Amount = (long?)requestDto?.Amount,
                CurrencyCode = requestDto?.Currency.ToString()
            },
            IsFinal = requestDto?.IsFinal
        };
    }
}