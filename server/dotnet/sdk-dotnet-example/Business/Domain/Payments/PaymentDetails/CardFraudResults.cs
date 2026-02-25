namespace Business.Domain.Payments.PaymentDetails;

public class CardFraudResults
{
    public string? FraudServiceResult { get; set; }
    
    public string? AvsResult { get; set; }
    
    public string? CvvResult { get; set; }
}