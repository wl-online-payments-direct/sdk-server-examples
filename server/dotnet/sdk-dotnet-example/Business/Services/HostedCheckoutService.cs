using Business.DTOs.CreateHostedCheckouts;
using Business.DTOs.GetPaymentByHostedCheckoutId;
using Business.Interfaces.SDKClients;
using Business.Interfaces.Services;

namespace Business.Services;

public class HostedCheckoutService(IHostedCheckoutClient hostedCheckoutClient)
    : IHostedCheckoutService
{
    public async Task<CreateHostedCheckoutResponseDto> CreateHostedCheckoutSessionsAsync(
        CreateHostedCheckoutRequestDto request)
    {
        CreateHostedCheckoutResponseDto responseDto =
            await hostedCheckoutClient.CreateHostedCheckoutSessionAsync(request);

        responseDto.Amount = request.Amount;
        responseDto.Currency = request.Currency;

        return responseDto;
    }

    public async Task<GetPaymentByHostedCheckoutIdResponseDto?> GetPaymentByHostedCheckoutIdAsync(
        string id)
    {
        return await hostedCheckoutClient.GetPaymentByHostedCheckoutIdAsync(id);
    }
}