using Business.DTOs.CreateHostedCheckouts;
using Business.DTOs.GetPaymentByHostedCheckoutId;

namespace Business.Interfaces.Services;

public interface IHostedCheckoutService
{
    public Task<CreateHostedCheckoutResponseDto> CreateHostedCheckoutSessionsAsync(
        CreateHostedCheckoutRequestDto request);

    public Task<GetPaymentByHostedCheckoutIdResponseDto?> GetPaymentByHostedCheckoutIdAsync(string id);
}