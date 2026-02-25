using Business.DTOs.CreatePayments;
using Presentation.Models.CreatePayments;

namespace Presentation.Mappers;

public static class PaymentMapper
{
    private const int SmallestUnit = 100;
    
    public static CreatePaymentRequestDto Map(CreatePaymentRequest request)
    {
        return new()
        {
            Amount = request.Amount * SmallestUnit,
            Currency = request.Currency,
            Card = request.Card,
            Mandate = request.Mandate,
            Method = request.Method,
            BillingAddress = request.BillingAddress,
            ShippingAddress = request.ShippingAddress,
            HostedTokenizationId = request.HostedTokenizationId
        };
    }
    
    public static CreatePaymentResponse Map( CreatePaymentResponseDto response)
    {
        return new()
        {
            Id = response.Id,
            Status = response.Status,
            StatusOutput = response.StatusOutput
        };
    }
}