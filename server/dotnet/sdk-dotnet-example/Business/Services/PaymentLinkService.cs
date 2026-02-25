using Business.DTOs.CreatePaymentLinks;
using Business.Interfaces.SDKClients;
using Business.Interfaces.Services;

namespace Business.Services;

public class PaymentLinkService(IPaymentLinkClient paymentLinkClient) : IPaymentLinkService
{
    public async Task<CreatePaymentLinkResponseDto> CreatePaymentLinkAsync(CreatePaymentLinkRequestDto request)
    {
        CreatePaymentLinkResponseDto responseDto =
            await paymentLinkClient.CreatePaymentLinkAsync(request);
        
        return responseDto;
    }
}