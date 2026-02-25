namespace Business.Domain.Payments.PaymentDetails;

public class RedirectPaymentMethodSpecificOutput
{
    public string? AuthorisationCode { get; set; }

    public CustomerBankAccount? CustomerBankAccount { get; set; }

    public FraudResults? FraudResults { get; set; }

    public string? PaymentOption { get; set; }

    public PaymentProduct3203SpecificOutput? PaymentProduct3203SpecificOutput { get; set; }

    public PaymentProduct5001SpecificOutput? PaymentProduct5001SpecificOutput { get; set; }

    public PaymentProduct5402SpecificOutput? PaymentProduct5402SpecificOutput { get; set; }

    public PaymentProduct5500SpecificOutput? PaymentProduct5500SpecificOutput { get; set; }

    public PaymentProduct840SpecificOutput? PaymentProduct840SpecificOutput { get; set; }

    public int? PaymentProductId { get; set; }

    public string? Token { get; set; }
}