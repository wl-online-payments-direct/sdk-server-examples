using Business.DTOs.HostedTokenizations;
using OnlinePayments.Sdk.Domain;

namespace Infrastructure.Mappers;

public static class HostedTokenizationMapper
{
    public static GetHostedTokenizationResponseDto Map(CreateHostedTokenizationResponse? response)
    {
        return new()
        {
            HostedTokenizationId = response?.HostedTokenizationId,
            HostedTokenizationUrl = response?.HostedTokenizationUrl
        };
    }
}