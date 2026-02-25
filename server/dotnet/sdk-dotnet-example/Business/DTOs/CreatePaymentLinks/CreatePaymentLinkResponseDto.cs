using Business.Domain.Common.Enums;
using Business.Domain.Enums.PaymentLinks;

namespace Business.DTOs.CreatePaymentLinks;

public class CreatePaymentLinkResponseDto
{
    public string? PaymentLinkId { get; init; }
    
    public string? RedirectUrl { get; init; }
    
    public Status? Status { get; init; }
    
    public decimal? Amount { get; init; }
    
    public Currency? Currency { get; init; }
}