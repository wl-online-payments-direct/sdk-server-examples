using Business.DTOs.HostedTokenizations;
using Business.Interfaces.SDKClients;
using Business.Interfaces.Services;

namespace Business.Services;

public class HostedTokenizationService(IHostedTokenizationClient hostedTokenizationClient) : 
    IHostedTokenizationService
{
    public async Task<GetHostedTokenizationResponseDto> InitHostedTokenizationAsync()
    {
        GetHostedTokenizationResponseDto responseDto = await hostedTokenizationClient.InitHostedTokenizationAsync();
        
        return responseDto;
    }
}