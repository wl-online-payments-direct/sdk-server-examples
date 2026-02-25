using Business.DTOs.AdditionalPaymentActions;
using Presentation.Models.AdditionalPaymentActions;

namespace Presentation.Extensions;

public static class AdditionalPaymentActionExtension
{
    public static AdditionalPaymentActionRequestDto Map(this AdditionalPaymentActionRequest request, string id)
    {
        return new()
        {
            Currency = request.Currency,
            IsFinal = request.IsFinal,
            Amount = request.Amount,
            Id = id
        };
    }
    
    public static AdditionalPaymentActionResponse Map(this AdditionalPaymentActionResponseDto? response)
    {
        return new()
        {
            Id = response?.Id,
            Status = response?.Status,
            StatusOutput = response?.StatusOutput
        };
    }
}