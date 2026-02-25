using Business.Domain.Payments;
using Business.DTOs.CreatePayments;
using Business.Interfaces.SDKClients;
using Infrastructure.Mappers;
using Infrastructure.Mappers.Exceptions;
using OnlinePayments.Sdk;
using OnlinePayments.Sdk.Domain;
using OnlinePayments.Sdk.Merchant;
using MandateResponse = Business.Domain.Payments.MandateResponse;

namespace Infrastructure.SDKClients;

public class MandateClient(ILogger<PaymentLinkClient> logger, IMerchantClient merchantClient) : IMandateClient
{
    public async Task<Mandate> CreateMandate(CreatePaymentRequestDto mandateRequest)
    {
        try
        {
            CreateMandateRequest requestSdk = MandateMapper.Map(mandateRequest);
            logger.LogInformation("Creating mandate start.");
            CreateMandateResponse mandateResponse = await merchantClient.Mandates.CreateMandate(requestSdk);
            logger.LogInformation("Successful mandate with unique mandate reference: {}",
                mandateResponse.Mandate.UniqueMandateReference);
            Mandate response = MandateMapper.Map(mandateResponse);

            return response;
        }
        catch (ApiException ex)
        {
            throw ExceptionMapper.Map(ex);
        }
    }

    public async Task<MandateResponse?> GetMandate(string? existingUniqueMandateReference)
    {
        MandateResponse? mandate = null;
        try
        {
            logger.LogInformation("Get mandate request.");
            GetMandateResponse? mandateResponse =
                await merchantClient.Mandates.GetMandate(existingUniqueMandateReference);
            logger.LogInformation("Mandate retrieved successfully.");
            mandate = MandateMapper.Map(mandateResponse);
            
            return mandate;
        }
        catch (ReferenceException ex)
        {
            throw ExceptionMapper.Map(ex, $"Mandate with reference: {mandate?.UniqueMandateReference} not found.");
        }
    }
}