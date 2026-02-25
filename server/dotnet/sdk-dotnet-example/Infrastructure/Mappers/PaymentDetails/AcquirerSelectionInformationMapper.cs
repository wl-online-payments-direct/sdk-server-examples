using AcquirerSelectionInformationSdk = OnlinePayments.Sdk.Domain.AcquirerSelectionInformation;
using AcquirerSelectionInformationDto = Business.Domain.Payments.PaymentDetails.AcquirerSelectionInformation;

namespace Infrastructure.Mappers.PaymentDetails;

public static class AcquirerSelectionInformationMapper
{
    public static AcquirerSelectionInformationDto Map(AcquirerSelectionInformationSdk? response)
    {
        return new()
        {
            FallbackLevel = response?.FallbackLevel,
            RuleName = response?.RuleName,
            Result = response?.Result
        };
    }
}