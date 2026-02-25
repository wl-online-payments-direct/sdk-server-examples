namespace Business.Domain.Payments.PaymentDetails;

public class ReattemptInstructions
{
    public ReattemptInstructionsConditions? Conditions { get; set; }
    
    public int? FrozenPeriod { get; set; }
    
    public string? Indicator { get; set; }
}