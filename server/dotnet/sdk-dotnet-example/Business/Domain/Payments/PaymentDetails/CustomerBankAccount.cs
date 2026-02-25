namespace Business.Domain.Payments.PaymentDetails;

public class CustomerBankAccount
{
    public string? AccountHolderName { get; set; }

    public string? Bic { get; set; }

    public string? Iban { get; set; }
}