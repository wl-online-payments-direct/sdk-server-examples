using Business.Domain.Enums.Payments;
using Business.DTOs.CreatePayments;
using Business.DTOs.Services;
using Business.Interfaces.Handlers;
using Business.Interfaces.SDKClients;

namespace Business.Handlers;

public class CreditCardPaymentHandler(IPaymentClient paymentClient, IServiceClient serviceClient) : IPaymentMethodHandler
{
    public PaymentMethodType SupportedMethod => PaymentMethodType.CREDIT_CARD;

    public async Task<CreatePaymentResponseDto> HandleAsync(CreatePaymentRequestDto request)
    {
        if (!string.IsNullOrEmpty(request.Card?.Number))
        { 
            GetIinDetailsResponseDto? responseDto = await serviceClient.GetIinDetails(new()
            {
                Bin = request.Card.Number,
            });
            request.PaymentProductId = responseDto?.PaymentProductId;
        }
        
        return await paymentClient.CreatePaymentAsync(request);
    }
}