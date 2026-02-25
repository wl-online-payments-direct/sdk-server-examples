namespace Business.Domain.Payments.PaymentDetails;

public class ExternalTokenLinked
{
    public string? ComputedToken { get; set; }

    public string? GTSComputedToken { get; set; }

    public string? GeneratedToken { get; set; }
}