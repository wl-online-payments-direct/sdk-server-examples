namespace Business.Domain.Payments.PaymentDetails;

public class APIError
{
    public string? Category { get; set; }

    public string? Code { get; set; }

    public string? ErrorCode { get; set; }

    public int? HttpStatusCode { get; set; }

    public string? Id { get; set; }

    public string? Message { get; set; }

    public string? PropertyName { get; set; }

    public bool? Retriable { get; set; }
}