using Business.DTOs.AdditionalPaymentActions;
using Business.DTOs.CreatePayments;
using Business.DTOs.GetPaymentDetails;

namespace Business.Interfaces.Services;

public interface IPaymentService
{
    Task<CreatePaymentResponseDto> CreatePaymentAsync(CreatePaymentRequestDto request);
    
    Task<AdditionalPaymentActionResponseDto> RefundPaymentAsync(AdditionalPaymentActionRequestDto dto);
    
    Task<AdditionalPaymentActionResponseDto> CapturePaymentAsync(AdditionalPaymentActionRequestDto dto);
    
    Task<AdditionalPaymentActionResponseDto> CancelPaymentAsync(AdditionalPaymentActionRequestDto dto);
    
    Task<PaymentDetailsResponseDto?>  GetPaymentDetailsById(string id);
}