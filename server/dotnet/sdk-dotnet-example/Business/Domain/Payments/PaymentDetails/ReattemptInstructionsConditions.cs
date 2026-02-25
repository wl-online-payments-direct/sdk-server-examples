namespace Business.Domain.Payments.PaymentDetails;

public class ReattemptInstructionsConditions
{
    public int? MaxAttempts { get; set; }

    public int? MaxDelay { get; set; }
}