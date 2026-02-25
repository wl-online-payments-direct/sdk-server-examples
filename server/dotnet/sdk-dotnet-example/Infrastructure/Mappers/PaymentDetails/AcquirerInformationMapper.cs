using AcquirerInformationSdk = OnlinePayments.Sdk.Domain.AcquirerInformation;
using AcquirerInformationDto = Business.Domain.Payments.PaymentDetails.AcquirerInformation;

namespace Infrastructure.Mappers.PaymentDetails;

public static class AcquirerInformationMapper
{
    public static AcquirerInformationDto Map(AcquirerInformationSdk? response)
    {
        return new()
        {
            AcquirerSelectionInformation = AcquirerSelectionInformationMapper.Map(response?.AcquirerSelectionInformation),
            Name = response?.Name
        };
    }
}