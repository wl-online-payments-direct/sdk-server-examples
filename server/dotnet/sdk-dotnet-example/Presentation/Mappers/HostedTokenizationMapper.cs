using Business.DTOs.HostedTokenizations;
using Presentation.Models.GetHostedTokenizations;

namespace Presentation.Mappers;

public static class HostedTokenizationMapper
{
    public static GetHostedTokenizationResponse Map(GetHostedTokenizationResponseDto response)
    {
        return new()
        {
            HostedTokenizationId = response.HostedTokenizationId,
            HostedTokenizationUrl = response.HostedTokenizationUrl
        };
    }
}