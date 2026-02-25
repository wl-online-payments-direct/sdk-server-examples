using Business.Domain.Common.Enums;

namespace Presentation.Models.CreateHostedCheckouts;

public class CreateHostedCheckoutResponse
{
    public string? HostedCheckoutId { get; init; }
    
    public string? RedirectUrl { get; init; }
    
    public string? ReturnMAC { get; init; }
    
    public decimal? Amount { get; init; }
    
    public Currency? Currency { get; init; }
}