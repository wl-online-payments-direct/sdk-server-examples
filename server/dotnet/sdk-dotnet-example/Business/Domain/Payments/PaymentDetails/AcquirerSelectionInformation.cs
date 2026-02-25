namespace Business.Domain.Payments.PaymentDetails;

public class AcquirerSelectionInformation
{
    public int? FallbackLevel { get; set; }

    public string? Result { get; set; }

    public string? RuleName { get; set; }
}