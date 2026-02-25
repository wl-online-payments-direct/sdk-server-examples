using Business.DTOs.CreateHostedCheckouts;
using Business.DTOs.GetPaymentByHostedCheckoutId;
using Business.Interfaces.SDKClients;
using Infrastructure.Mappers;
using Infrastructure.Mappers.Exceptions;
using OnlinePayments.Sdk;
using OnlinePayments.Sdk.Domain;
using OnlinePayments.Sdk.Merchant;

namespace Infrastructure.SDKClients;

public class HostedCheckoutClient(ILogger<HostedCheckoutClient> logger, IMerchantClient merchantClient)
    : IHostedCheckoutClient
{
    public async Task<CreateHostedCheckoutResponseDto> CreateHostedCheckoutSessionAsync(
        CreateHostedCheckoutRequestDto request)
    {
        try
        {
            CreateHostedCheckoutRequest requestSdk = HostedCheckoutMapper.Map(request);
            logger.LogInformation("Creating hosted checkout request for payment - Amount: {}; Currency: {}.",
                requestSdk.Order.AmountOfMoney.Amount, requestSdk.Order.AmountOfMoney.CurrencyCode);
            CreateHostedCheckoutResponse
                response = await merchantClient.HostedCheckout.CreateHostedCheckout(requestSdk);
            logger.LogInformation("Successful hosted checkout - Redirect url: {}.", response.RedirectUrl);

            return HostedCheckoutMapper.Map(response);
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex);
        }
    }

    public async Task<GetPaymentByHostedCheckoutIdResponseDto?> GetPaymentByHostedCheckoutIdAsync(string id)
    {
        try
        {
            logger.LogInformation("Get details for payment with hosted checkout id: {}.", id);
            GetHostedCheckoutResponse? response = await merchantClient.HostedCheckout.GetHostedCheckout(id);
            logger.LogInformation("Payment details retrieved successfully.");

            return HostedCheckoutMapper.Map(response);
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex);
        }
    }
}