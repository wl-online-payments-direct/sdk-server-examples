using Business.Domain.Common;
using Business.Domain.Common.Enums;
using Business.Domain.Enums.Payments;
using Business.Domain.Payments;

namespace Presentation.Models.CreatePayments;

public class CreatePaymentRequest
{
    public decimal? Amount { get; init; }
    
    public Currency? Currency { get; init; }
    
    public PaymentMethodType? Method { get; init; }

    public string? HostedTokenizationId { get; init; }

    public AddressDto? ShippingAddress { get; init; } = new();
    
    public AddressDto? BillingAddress { get; init; } = new();

    public Card? Card { get; init; } = new();

    public Mandate? Mandate { get; init; } = new();
}