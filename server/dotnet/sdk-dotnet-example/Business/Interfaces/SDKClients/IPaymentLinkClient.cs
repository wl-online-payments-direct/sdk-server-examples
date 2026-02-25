using Business.DTOs.CreatePaymentLinks;

namespace Business.Interfaces.SDKClients;

public interface IPaymentLinkClient
{
    Task<CreatePaymentLinkResponseDto> CreatePaymentLinkAsync(CreatePaymentLinkRequestDto request);
}