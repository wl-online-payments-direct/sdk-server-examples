namespace Business.Domain.Payments.PaymentDetails;

public class OperationOutput
{
    public AmountOfMoney? AmountOfMoney { get; set; }

    public string? Id { get; set; }

    public OperationPaymentReferences? OperationReferences { get; set; }

    public string? PaymentMethod { get; set; }

    public PaymentReferences? References { get; set; }

    public string? Status { get; set; }

    public PaymentStatusOutput? StatusOutput { get; set; }
}