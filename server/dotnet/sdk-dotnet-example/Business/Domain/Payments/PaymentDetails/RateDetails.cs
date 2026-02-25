namespace Business.Domain.Payments.PaymentDetails;

public class RateDetails
{
    public decimal? ExchangeRate { get; set; }

    public decimal? InvertedExchangeRate { get; set; }

    public decimal? MarkUpRate { get; set; }

    public string? QuotationDateTime { get; set; }

    public string? Source { get; set; }
}