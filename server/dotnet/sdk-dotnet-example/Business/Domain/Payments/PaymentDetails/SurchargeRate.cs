namespace Business.Domain.Payments.PaymentDetails;

public class SurchargeRate
{
    public decimal? AdValoremRate { get; set; }

    public int? SpecificRate { get; set; }

    public string? SurchargeProductTypeId { get; set; }

    public string? SurchargeProductTypeVersion { get; set; }
}