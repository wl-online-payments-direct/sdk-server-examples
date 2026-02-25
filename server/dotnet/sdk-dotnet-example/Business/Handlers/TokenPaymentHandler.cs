using Business.Domain.Enums.Payments;
using Business.DTOs.CreatePayments;
using Business.Interfaces.Handlers;
using Business.Interfaces.SDKClients;

namespace Business.Handlers;

public class TokenPaymentHandler(IPaymentClient paymentClient) : IPaymentMethodHandler
{
    public PaymentMethodType SupportedMethod => PaymentMethodType.TOKEN;

    public async Task<CreatePaymentResponseDto> HandleAsync(CreatePaymentRequestDto request)
    {
        return await paymentClient.CreatePaymentAsync(request);
    }
}