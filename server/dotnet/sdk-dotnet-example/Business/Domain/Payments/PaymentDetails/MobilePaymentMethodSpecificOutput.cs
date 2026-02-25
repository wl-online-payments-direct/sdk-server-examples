namespace Business.Domain.Payments.PaymentDetails;

public class MobilePaymentMethodSpecificOutput
{
    public string? AuthorisationCode { get; set; }

    public CardFraudResults? FraudResults { get; set; }

    public string? Network { get; set; }

    public MobilePaymentData? PaymentData { get; set; }

    public int? PaymentProductId { get; set; }

    public ThreeDSecureResults? ThreeDSecureResults { get; set; }
}