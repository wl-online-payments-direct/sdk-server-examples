using Business.Domain.Common;
using Business.Domain.Common.Enums;
using Business.Domain.Enums.Payments;
using Business.Domain.Payments;

namespace Business.DTOs.CreatePayments;

public class CreatePaymentRequestDto
{
    public decimal? Amount { get; init; }
    
    public Currency? Currency { get; init; }
    
    public PaymentMethodType? Method { get; init; }

    public string? HostedTokenizationId { get; init; }
    
    public int? PaymentProductId { get; set; }
    
    public AddressDto? ShippingAddress { get; init; }  = new();
    
    public AddressDto? BillingAddress { get; init; }  = new();

    public Card? Card { get; init; }  = new();

    public Mandate? Mandate { get; set; }  = new();
}