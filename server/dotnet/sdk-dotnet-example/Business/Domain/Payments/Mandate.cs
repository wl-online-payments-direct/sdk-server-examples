using Business.Domain.Common;
using Business.Domain.Enums.Payments;

namespace Business.Domain.Payments;

public class Mandate
{
    public string? IBAN { get; set; }
    
    public string? CustomerReference { get; set; }
    
    public string? MandateReference { get; set; }

    public RecurrenceType? RecurrenceType { get; set; }

    public SignatureType? SignatureType { get; set; }

    public string? ReturnUrl { get; set; }

    public AddressDto? Address { get; set; }
}