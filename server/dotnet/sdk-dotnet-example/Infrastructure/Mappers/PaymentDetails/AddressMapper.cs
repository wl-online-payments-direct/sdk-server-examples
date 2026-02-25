using AddressSdk = OnlinePayments.Sdk.Domain.Address;
using AddressDto = Business.Domain.Payments.PaymentDetails.Address;

namespace Infrastructure.Mappers.PaymentDetails;

public static class AddressMapper
{
    public static AddressDto Map(AddressSdk? response)
    {
        return new()
        {
            City = response?.City,
            CountryCode = response?.CountryCode,
            AdditionalInfo = response?.AdditionalInfo,
            HouseNumber = response?.HouseNumber,
            State = response?.State,
            Street = response?.Street,
            Zip = response?.Zip
        };
    }
}