using CustomerDeviceOutputSdk = OnlinePayments.Sdk.Domain.CustomerDeviceOutput;
using CustomerDeviceOutputDto = Business.Domain.Payments.PaymentDetails.CustomerDeviceOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class CustomerDeviceOutputMapper
{
    public static CustomerDeviceOutputDto Map(CustomerDeviceOutputSdk? response)
    {
        return new()
        {
            IpAddressCountryCode = response?.IpAddressCountryCode
        };
    }
}