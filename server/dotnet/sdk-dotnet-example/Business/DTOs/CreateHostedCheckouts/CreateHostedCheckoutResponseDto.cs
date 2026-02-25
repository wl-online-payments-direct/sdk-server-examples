using Business.Domain.Common.Enums;

namespace Business.DTOs.CreateHostedCheckouts;

public class CreateHostedCheckoutResponseDto
{
    public string? HostedCheckoutId { get; init; }
    
    public string? RedirectUrl { get; init; }
    
    public string? ReturnMAC { get; init; }
    
    public decimal? Amount { get; set; }
    
    public Currency? Currency { get; set; }
}