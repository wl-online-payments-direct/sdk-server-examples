namespace Business.Domain.Payments.PaymentDetails;

public class DccProposal
{
    public AmountOfMoney? BaseAmount { get; set; }

    public string? DisclaimerDisplay { get; set; }

    public string? DisclaimerReceipt { get; set; }

    public RateDetails? Rate { get; set; }

    public AmountOfMoney? TargetAmount { get; set; }
}