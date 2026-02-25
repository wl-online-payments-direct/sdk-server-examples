using Business.DTOs.AdditionalPaymentActions;
using Business.DTOs.CreatePayments;
using Business.DTOs.GetPaymentDetails;
using Business.Interfaces.SDKClients;
using Infrastructure.Mappers;
using Infrastructure.Mappers.AdditionalPaymentActions;
using Infrastructure.Mappers.Exceptions;
using OnlinePayments.Sdk;
using OnlinePayments.Sdk.Domain;
using OnlinePayments.Sdk.Merchant;

namespace Infrastructure.SDKClients;

public class PaymentClient(ILogger<PaymentLinkClient> logger, IMerchantClient merchantClient) : IPaymentClient
{
    public async Task<CreatePaymentResponseDto> CreatePaymentAsync(CreatePaymentRequestDto request)
    {
        try
        {
            CreatePaymentRequest requestSdk = PaymentMapper.Map(request);
            logger.LogInformation("Creating payment request for payment - Amount: {}; Currency: {}.",
                requestSdk.Order.AmountOfMoney.Amount,
                requestSdk.Order.AmountOfMoney.CurrencyCode
            );
            CreatePaymentResponse paymentResponse = await merchantClient.Payments.CreatePayment(requestSdk);
            logger.LogInformation("Successful payment with payment id: {}", paymentResponse.Payment.Id);
        
            return PaymentMapper.Map(paymentResponse);
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex);
        }
    }

    public async Task<PaymentDetailsResponseDto?> GetPaymentDetailsById(string id)
    {
        try
        {
            logger.LogInformation("Get details for payment with id: {}.", id);
            PaymentDetailsResponse? response = await merchantClient.Payments.GetPaymentDetails(id);
            logger.LogInformation("Payment details retrieved successfully.");
        
            return PaymentDetailsMapper.Map(response);
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex);
        }
    }

    public async Task<AdditionalPaymentActionResponseDto> RefundPaymentAsync(AdditionalPaymentActionRequestDto request, string id)
    {
        try
        {
            RefundRequest requestSdk = RefundPaymentMapper.Map(request);
            logger.LogInformation("Refund for payment - Id: {}; Amount: {}.", id, requestSdk.AmountOfMoney.Amount);
            RefundResponse response = await merchantClient.Payments.RefundPayment(id, requestSdk);
            logger.LogInformation("Successful refund for payment.");
        
            return RefundPaymentMapper.Map(response);
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex);
        }
    }

    public async Task<AdditionalPaymentActionResponseDto> CapturePaymentAsync(AdditionalPaymentActionRequestDto request, string id)
    {
        try
        {
            CapturePaymentRequest requestSdk = CapturePaymentMapper.Map(request);
            logger.LogInformation("Capture for payment - Id: {}; Amount: {}.", id, requestSdk.Amount);
            CaptureResponse response = await merchantClient.Payments.CapturePayment(id, requestSdk);
            logger.LogInformation("Successful capture for payment.");
        
            return CapturePaymentMapper.Map(response);
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex);
        }
    }

    public async Task<AdditionalPaymentActionResponseDto> CancelPaymentAsync(AdditionalPaymentActionRequestDto request, string id)
    {
        try
        {
            CancelPaymentRequest requestSdk = CancelPaymentMapper.Map(request);
            logger.LogInformation("Cancel for payment - Id: {}; Amount: {}.", id, requestSdk.AmountOfMoney.Amount);
            CancelPaymentResponse response = await merchantClient.Payments.CancelPayment(id, requestSdk);
            logger.LogInformation("Successful cancel for payment.");

            return CancelPaymentMapper.Map(response);
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex);
        }
    }
}