namespace Business.Domain.Payments.PaymentDetails;

public class SepaDirectDebitPaymentMethodSpecificOutput
{
    public FraudResults? FraudResults { get; set; }

    public PaymentProduct771SpecificOutput? PaymentProduct771SpecificOutput { get; set; }

    public int? PaymentProductId { get; set; }
}