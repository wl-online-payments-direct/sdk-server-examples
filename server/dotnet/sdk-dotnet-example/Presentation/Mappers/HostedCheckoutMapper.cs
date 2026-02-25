using Business.DTOs.CreateHostedCheckouts;
using Business.DTOs.GetPaymentByHostedCheckoutId;
using Presentation.Models.CreateHostedCheckouts;
using Presentation.Models.GetPaymentByHostedCheckoutId;

namespace Presentation.Mappers;

public static class HostedCheckoutMapper
{
    private const int SmallestUnit = 100;
    
    public static CreateHostedCheckoutRequestDto Map(CreateHostedCheckoutRequest request)
    {
        return new()
        {
            Amount = request.Amount * SmallestUnit,
            Currency = request.Currency,
            Language = request.Language,
            BillingAddress = request.BillingAddress,
            RedirectUrl = request.RedirectUrl,
            ShippingAddress = request.ShippingAddress
        };
    }
    
    public static CreateHostedCheckoutResponse Map(CreateHostedCheckoutResponseDto response)
    {
        return new()
        {
            Amount = response.Amount,
            Currency = response.Currency,
            RedirectUrl = response.RedirectUrl,
            HostedCheckoutId = response.HostedCheckoutId,
            ReturnMAC = response.ReturnMAC
        };
    }
    
    public static GetPaymentByHostedCheckoutIdResponse Map(GetPaymentByHostedCheckoutIdResponseDto idResponse)
    {
        return new()
        {
            Status = idResponse.Status,
            PaymentId = idResponse.PaymentId
        };
    }
}