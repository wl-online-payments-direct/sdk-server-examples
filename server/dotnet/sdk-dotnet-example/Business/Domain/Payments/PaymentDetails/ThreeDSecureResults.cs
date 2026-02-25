namespace Business.Domain.Payments.PaymentDetails;

public class ThreeDSecureResults
{
    public string? AcsTransactionId { get; set; }

    public string? AppliedExemption { get; set; }

    public string? AuthenticationStatus { get; set; }

    public string? Cavv { get; set; }

    public string? ChallengeIndicator { get; set; }

    public string? DsTransactionId { get; set; }

    public string? Eci { get; set; }

    public string? ExemptionEngineFlow { get; set; }

    public string? Flow { get; set; }

    public string? Liability { get; set; }

    public string? SchemeEci { get; set; }

    public string? Version { get; set; }

    public string? Xid { get; set; }
}