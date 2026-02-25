namespace Business.Domain.Payments.PaymentDetails;

public class CurrencyConversion
{
    public bool? AcceptedByUser { get; set; }

    public DccProposal? Proposal { get; set; }
}