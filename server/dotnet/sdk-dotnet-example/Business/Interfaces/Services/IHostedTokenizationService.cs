using Business.DTOs.HostedTokenizations;

namespace Business.Interfaces.Services;

public interface IHostedTokenizationService
{
    public Task<GetHostedTokenizationResponseDto> InitHostedTokenizationAsync();
}