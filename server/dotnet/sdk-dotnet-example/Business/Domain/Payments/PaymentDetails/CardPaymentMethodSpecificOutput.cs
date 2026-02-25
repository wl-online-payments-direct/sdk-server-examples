namespace Business.Domain.Payments.PaymentDetails;

public class CardPaymentMethodSpecificOutput
{
    public AcquirerInformation? AcquirerInformation { get; set; }

    public string? AuthorisationCode { get; set; }

    public CardEssentials? Card { get; set; }

    public CardFraudResults? FraudResults { get; set; }

    public string? PaymentAccountReference { get; set; }

    public int? PaymentProductId { get; set; }

    public ThreeDSecureResults? ThreeDSecureResults { get; set; }

    public string? InitialSchemeTransactionId { get; set; }
    
    public string? SchemeReferenceData { get; set; }
    
    public string? Token { get; set; }
    
    public string? PaymentOption { get; set; }
    
    public ExternalTokenLinked? ExternalTokenLinked { get; set; }
    
    public long? AuthenticatedAmount { get; set; }
    
    public CurrencyConversion? CurrencyConversion { get; set; }
    
    public PaymentProduct3208SpecificOutput? PaymentProduct3208SpecificOutput { get; set; }
    
    public PaymentProduct3209SpecificOutput? PaymentProduct3209SpecificOutput { get; set; }
    
    public ReattemptInstructions? ReattemptInstructions { get; set; }
}