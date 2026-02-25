using Business.Domain.Common.Enums;

namespace Business.Domain.Common;

public class AddressDto
{
    public string? FirstName { get; set; }
    
    public string? LastName { get; set; }
    
    public Country? Country { get; set; }
    
    public string? Zip { get; set; }
    
    public string? City { get; set; }
    
    public string? Street { get; set; }
}