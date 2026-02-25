namespace Business.Domain.Payments;

public class Card
{
    public string? Number { get; set; }
    
    public string? HolderName { get; set; }
    
    public string? VerificationCode { get; set; }
    
    public string? ExpiryMonth { get; set; }
    
    public string? ExpiryYear { get; set; }
}