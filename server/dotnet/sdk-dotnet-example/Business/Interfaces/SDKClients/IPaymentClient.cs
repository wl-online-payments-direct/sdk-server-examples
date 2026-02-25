using Business.DTOs.AdditionalPaymentActions;
using Business.DTOs.CreatePayments;
using Business.DTOs.GetPaymentDetails;

namespace Business.Interfaces.SDKClients;

public interface IPaymentClient
{
    public Task<CreatePaymentResponseDto> CreatePaymentAsync(CreatePaymentRequestDto request);
    
    public Task<PaymentDetailsResponseDto?> GetPaymentDetailsById(string id);
    
    Task<AdditionalPaymentActionResponseDto> RefundPaymentAsync(AdditionalPaymentActionRequestDto request, string id);
    
    Task<AdditionalPaymentActionResponseDto> CapturePaymentAsync(AdditionalPaymentActionRequestDto request, string id);
    
    Task<AdditionalPaymentActionResponseDto> CancelPaymentAsync(AdditionalPaymentActionRequestDto request, string id);
}