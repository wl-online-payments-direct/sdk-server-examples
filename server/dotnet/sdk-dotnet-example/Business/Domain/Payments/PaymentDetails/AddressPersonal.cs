namespace Business.Domain.Payments.PaymentDetails;

public class AddressPersonal
{
    public string? AdditionalInfo { get; set; }

    public string? City { get; set; }

    public string? CompanyName { get; set; }

    public string? CountryCode { get; set; }

    public string? HouseNumber { get; set; }

    public PersonalName? Name { get; set; }

    public string? State { get; set; }

    public string? Street { get; set; }

    public string? Zip { get; set; }
}