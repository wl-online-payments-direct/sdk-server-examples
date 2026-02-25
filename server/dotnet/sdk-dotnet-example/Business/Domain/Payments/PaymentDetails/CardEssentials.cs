namespace Business.Domain.Payments.PaymentDetails;

public class CardEssentials
{
    public string? Bin { get; set; }

    public string? CardNumber { get; set; }

    public string? CountryCode { get; set; }

    public string? ExpiryDate { get; set; }
}