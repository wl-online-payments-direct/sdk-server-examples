using CustomerOutputSdk = OnlinePayments.Sdk.Domain.CustomerOutput;
using CustomerOutputDto = Business.Domain.Payments.PaymentDetails.CustomerOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class CustomerOutputMapper
{
    public static CustomerOutputDto Map(CustomerOutputSdk? response)
    {
        return new()
        {
            Device = CustomerDeviceOutputMapper.Map(response?.Device)
        };
    }
}