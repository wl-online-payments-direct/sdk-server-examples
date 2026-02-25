using Business.DTOs.CreateHostedCheckouts;
using Business.DTOs.GetPaymentByHostedCheckoutId;

namespace Business.Interfaces.SDKClients;

public interface IHostedCheckoutClient
{
    public Task<CreateHostedCheckoutResponseDto> CreateHostedCheckoutSessionAsync(CreateHostedCheckoutRequestDto request);
    public Task<GetPaymentByHostedCheckoutIdResponseDto?> GetPaymentByHostedCheckoutIdAsync(string id);
}