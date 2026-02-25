using Business.Domain.Common;
using Business.Domain.Common.Enums;

namespace Presentation.Models.CreateHostedCheckouts;

public class CreateHostedCheckoutRequest
{
    public decimal? Amount { get; init; }
    
    public Currency? Currency { get; init; }
    
    public Language? Language { get; init; }
    
    public string? RedirectUrl { get; init; }
    
    public AddressDto? ShippingAddress { get; init; }
    
    public AddressDto? BillingAddress { get; init; }
}