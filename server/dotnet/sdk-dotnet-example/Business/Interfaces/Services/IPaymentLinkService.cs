using Business.DTOs.CreatePaymentLinks;

namespace Business.Interfaces.Services;

public interface IPaymentLinkService
{
    public Task<CreatePaymentLinkResponseDto> CreatePaymentLinkAsync(CreatePaymentLinkRequestDto request);
}