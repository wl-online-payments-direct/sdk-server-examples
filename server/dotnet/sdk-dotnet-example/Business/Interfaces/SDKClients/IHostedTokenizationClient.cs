using Business.DTOs.HostedTokenizations;

namespace Business.Interfaces.SDKClients;

public interface IHostedTokenizationClient
{
    public Task<GetHostedTokenizationResponseDto> InitHostedTokenizationAsync();
}