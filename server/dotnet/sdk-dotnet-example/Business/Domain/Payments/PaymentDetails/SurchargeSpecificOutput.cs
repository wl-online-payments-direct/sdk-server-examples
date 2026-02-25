namespace Business.Domain.Payments.PaymentDetails;

public class SurchargeSpecificOutput
{
    public string? Mode { get; set; }

    public AmountOfMoney? SurchargeAmount { get; set; }

    public SurchargeRate? SurchargeRate { get; set; }
}