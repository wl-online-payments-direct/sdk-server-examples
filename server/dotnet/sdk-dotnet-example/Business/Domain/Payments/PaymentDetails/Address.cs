namespace Business.Domain.Payments.PaymentDetails;

public class Address
{
    public string? AdditionalInfo { get; set; }

    public string? City { get; set; }

    public string? CountryCode { get; set; }

    public string? HouseNumber { get; set; }

    public string? State { get; set; }

    public string? Street { get; set; }

    public string? Zip { get; set; }
}