namespace Business.Domain.Payments.PaymentDetails;

public class PaymentProduct840SpecificOutput
{
    public Address? BillingAddress { get; set; }

    public PaymentProduct840CustomerAccount? CustomerAccount { get; set; }

    public Address? CustomerAddress { get; set; }

    public ProtectionEligibility? ProtectionEligibility { get; set; }
}