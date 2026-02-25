using Business.DTOs.GetPaymentDetails;
using Presentation.Models.GetPaymentDetails;

namespace Presentation.Mappers;

public static class PaymentDetailsMapper
{
    public static PaymentDetailsResponse Map(PaymentDetailsResponseDto response)
    {
        return new()
        {
            Id = response.Id,
            Status = response.Status,
            StatusOutput = response.StatusOutput,
            Operations = response.Operations,
            PaymentOutput = response.PaymentOutput,
            HostedCheckoutSpecificOutput = response.HostedCheckoutSpecificOutput
        };
    }
}