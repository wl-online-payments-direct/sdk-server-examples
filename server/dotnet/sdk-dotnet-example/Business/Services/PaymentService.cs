using System.Net;
using Business.DTOs.AdditionalPaymentActions;
using Business.DTOs.CreatePayments;
using Business.DTOs.GetPaymentDetails;
using Business.Exceptions;
using Business.Interfaces.Handlers;
using Business.Interfaces.SDKClients;
using Business.Interfaces.Services;

namespace Business.Services;

public class PaymentService(IEnumerable<IPaymentMethodHandler> handlers, IPaymentClient paymentClient)
    : IPaymentService
{
    public async Task<CreatePaymentResponseDto> CreatePaymentAsync(CreatePaymentRequestDto request)
    {
        var handler = handlers.FirstOrDefault(x => x.SupportedMethod == request.Method);
        
        if (handler == null)
        {
            throw new SdkException("Unsupported payment method.", HttpStatusCode.BadRequest);
        }

        CreatePaymentResponseDto response = await handler.HandleAsync(request);

        return response;
    }

    public async Task<AdditionalPaymentActionResponseDto> CancelPaymentAsync(
        AdditionalPaymentActionRequestDto requestDto)
    {
        AdditionalPaymentActionResponseDto responseSdk =
            await paymentClient.CancelPaymentAsync(requestDto, requestDto.Id);

        return responseSdk;
    }

    public async Task<AdditionalPaymentActionResponseDto> CapturePaymentAsync(
        AdditionalPaymentActionRequestDto requestDto)
    {
        AdditionalPaymentActionResponseDto responseDto =
            await paymentClient.CapturePaymentAsync(requestDto, requestDto.Id);

        return responseDto;
    }

    public async Task<AdditionalPaymentActionResponseDto> RefundPaymentAsync(
        AdditionalPaymentActionRequestDto requestDto)
    {
        AdditionalPaymentActionResponseDto responseDto =
            await paymentClient.RefundPaymentAsync(requestDto, requestDto.Id);

        return responseDto;
    }

    public async Task<PaymentDetailsResponseDto?> GetPaymentDetailsById(string id)
    {
        PaymentDetailsResponseDto? result = await paymentClient.GetPaymentDetailsById(id);

        return result;
    }
}