using Business.DTOs.Services;

namespace Business.Interfaces.SDKClients;

public interface IServiceClient
{
   public Task<GetIinDetailsResponseDto?> GetIinDetails(GetIinDetailsRequestDto request);
}