using Business.DTOs.GetPaymentDetails;
using Infrastructure.Mappers.PaymentDetails;
using OnlinePayments.Sdk.Domain;
using OperationOutputDto = Business.Domain.Payments.PaymentDetails.OperationOutput;
using OperationOutputSdk = OnlinePayments.Sdk.Domain.OperationOutput;

namespace Infrastructure.Mappers;

public static class PaymentDetailsMapper
{
    public static PaymentDetailsResponseDto Map(PaymentDetailsResponse? response)
    {
        return new()
        {
            StatusOutput = PaymentStatusOutputMapper.Map(response?.StatusOutput),
            PaymentOutput = PaymentOutputMapper.Map(response?.PaymentOutput),
            Status = response?.Status,
            HostedCheckoutSpecificOutput =
                HostedCheckoutSpecificOutputMapper.Map(response?.HostedCheckoutSpecificOutput),
            Id = response?.Id,
            Operations = MapList(response?.Operations)
        };
    }

    private static IList<OperationOutputDto>? MapList(IList<OperationOutputSdk>? operations)
    {
        return operations?.ToList().Select(OperationOutputMapper.Map).ToList();
    }
}