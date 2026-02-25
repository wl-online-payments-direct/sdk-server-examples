using Business.DTOs.CreatePaymentLinks;
using Presentation.Models.CreatePaymentLinks;

namespace Presentation.Mappers;

public static class PaymentLinkMapper
{
    private const int SmallestUnit = 100;
    
    public static CreatePaymentLinkRequestDto Map(CreatePaymentLinkRequest request)
    {
        return new()
        {
            Amount = request.Amount * SmallestUnit,
            Currency = request.Currency,
            Action = request.Action,
            Description = request.Description,
            ValidFor = request.ValidFor
        };
    }
    
    public static CreatePaymentLinkResponse Map(CreatePaymentLinkResponseDto response)
    {
        if (response is null)
        {
            throw new ArgumentNullException(nameof(response));
        }

        return new()
        {
            Amount       = response.Amount 
                           ?? throw new InvalidDataException("PaymentLinkResponse.Amount is null"),
            Currency     = response.Currency 
                           ?? throw new InvalidDataException("PaymentLinkResponse.Currency is null"),
            Status       = response.Status 
                           ?? throw new InvalidDataException("PaymentLinkResponse.Status is null"),
            RedirectUrl  = response.RedirectUrl ?? string.Empty,
            PaymentLinkId= response.PaymentLinkId 
                           ?? throw new InvalidDataException("PaymentLinkResponse.PaymentLinkId is null")
        };
    }
}