namespace Business.Domain.Payments.PaymentDetails;

public class PaymentOutput
{
    public AmountOfMoney? AmountOfMoney { get; set; }
    
    public PaymentReferences? References { get; set; }
    
    public AmountOfMoney? AcquiredAmount { get; set; }
    
    public CustomerOutput? Customer { get; set; }
    
    public CardPaymentMethodSpecificOutput? CardPaymentMethodSpecificOutput { get; set; }
    
    public string? PaymentMethod { get; set; }
    
    public string? MerchantParameters { get; set; }
    
    public Discount? Discount { get; set; }
    
    public SurchargeSpecificOutput? SurchargeSpecificOutput { get; set; }
    
    public SepaDirectDebitPaymentMethodSpecificOutput? SepaDirectDebitPaymentMethodSpecificOutput { get; set; }
    
    public RedirectPaymentMethodSpecificOutput? RedirectPaymentMethodSpecificOutput { get; set; }
    
    public MobilePaymentMethodSpecificOutput? MobilePaymentMethodSpecificOutput { get; set; }
}