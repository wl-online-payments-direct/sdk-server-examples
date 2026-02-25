using Business.DTOs.CreatePaymentLinks;
using Business.Interfaces.SDKClients;
using Infrastructure.Mappers;
using Infrastructure.Mappers.Exceptions;
using OnlinePayments.Sdk;
using OnlinePayments.Sdk.Domain;
using OnlinePayments.Sdk.Merchant;

namespace Infrastructure.SDKClients;

public class PaymentLinkClient(ILogger<PaymentLinkClient> logger, IMerchantClient merchantClient) : IPaymentLinkClient
{
    public async Task<CreatePaymentLinkResponseDto> CreatePaymentLinkAsync(CreatePaymentLinkRequestDto request)
    {
        try
        {
            CreatePaymentLinkRequest requestSdk = PaymentLinkMapper.Map(request);
            logger.LogInformation("Creating payment link request for payment - Amount: {}; Currency: {}.",
                requestSdk.Order.AmountOfMoney.Amount, requestSdk.Order.AmountOfMoney.CurrencyCode);
            PaymentLinkResponse response = await merchantClient.PaymentLinks.CreatePaymentLink(requestSdk);
            logger.LogInformation("Successful payment link - Redirect url: {}.", response.RedirectionUrl);
            CreatePaymentLinkResponseDto responseDto = PaymentLinkMapper.Map(response);

            return responseDto;
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex);
        }
    }
}