using Business.DTOs.HostedTokenizations;
using Business.Interfaces.SDKClients;
using Infrastructure.Mappers;
using Infrastructure.Mappers.Exceptions;
using OnlinePayments.Sdk;
using OnlinePayments.Sdk.Domain;
using OnlinePayments.Sdk.Merchant;

namespace Infrastructure.SDKClients;

public class HostedTokenizationClient(ILogger<HostedCheckoutClient> logger, IMerchantClient merchantClient)
    : IHostedTokenizationClient
{
    public async Task<GetHostedTokenizationResponseDto> InitHostedTokenizationAsync()
    {
        try
        {
            logger.LogInformation("The generation of the hosted tokenization ID has started.");
            CreateHostedTokenizationResponse response =
                await merchantClient.HostedTokenization.CreateHostedTokenization(new CreateHostedTokenizationRequest());
            logger.LogInformation(
                "Generation of the hosted tokenization ID successfully completed - HostedTokenizationId: {}.",
                response.HostedTokenizationId);
            GetHostedTokenizationResponseDto responseDto = HostedTokenizationMapper.Map(response);

            return responseDto;
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex);
        }
    }
}