using System.Net;
using Business.DTOs.Services;
using Business.Exceptions;
using Business.Interfaces.SDKClients;
using Infrastructure.Mappers;
using Infrastructure.Mappers.Exceptions;
using OnlinePayments.Sdk;
using OnlinePayments.Sdk.Domain;
using OnlinePayments.Sdk.Merchant;

namespace Infrastructure.SDKClients;

public class ServiceClient(ILogger<ServiceClient> logger, IMerchantClient merchantClient) : IServiceClient
{
    public async Task<GetIinDetailsResponseDto?> GetIinDetails(GetIinDetailsRequestDto request)
    {
        try
        {
            logger.LogInformation($"Fetching the payment product id for card number: {request.Bin}");

            GetIINDetailsResponse serviceResponse =
                await merchantClient.Services.GetIINDetails(ServiceMapper.Map(request));
            GetIinDetailsResponseDto dtoResponse = ServiceMapper.Map(serviceResponse);

            if (serviceResponse.PaymentProductId == null)
            {
                logger.LogInformation($"No valid payment product id found for card number: {request.Bin}");
                throw new SdkException($"No valid payment product id found for card number: {request.Bin}",
                    HttpStatusCode
                        .BadRequest);
            }

            logger.LogInformation(
                $"Payment product id: {dtoResponse.PaymentProductId} returned for card number: {request.Bin}");

            return dtoResponse;
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex, $"Error occured while fetching payment product id: {request.Bin}");
        }
    }
}