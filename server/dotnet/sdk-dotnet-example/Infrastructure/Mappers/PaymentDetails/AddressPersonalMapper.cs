using AddressPersonalSdk = OnlinePayments.Sdk.Domain.AddressPersonal;
using AddressPersonalDto = Business.Domain.Payments.PaymentDetails.AddressPersonal;

namespace Infrastructure.Mappers.PaymentDetails;

public static class AddressPersonalMapper
{
    public static AddressPersonalDto Map(AddressPersonalSdk? response)
    {
        return new()
        {
            AdditionalInfo = response?.AdditionalInfo,
            City = response?.City,
            CountryCode = response?.CountryCode,
            HouseNumber = response?.HouseNumber,
            CompanyName = response?.CompanyName,
            Name = PersonalNameMapper.Map(response?.Name),
            State = response?.State,
            Zip = response?.Zip,
            Street = response?.Street
        };
    }
}