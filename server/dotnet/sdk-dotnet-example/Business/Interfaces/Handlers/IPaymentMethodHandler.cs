using Business.Domain.Enums.Payments;
using Business.DTOs.CreatePayments;

namespace Business.Interfaces.Handlers;

public interface IPaymentMethodHandler
{
    PaymentMethodType SupportedMethod { get; }

    Task<CreatePaymentResponseDto> HandleAsync(CreatePaymentRequestDto request);
}