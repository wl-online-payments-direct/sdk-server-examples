using Business.Domain.Payments.PaymentDetails;

namespace Business.DTOs.GetPaymentDetails;

public class PaymentDetailsResponseDto
{
    public IList<OperationOutput>? Operations { get; set; }

    public HostedCheckoutSpecificOutput? HostedCheckoutSpecificOutput { get; set; }

    public PaymentOutput? PaymentOutput { get; set; }

    public string? Status { get; set; }

    public PaymentStatusOutput? StatusOutput { get; set; }
    
    public string? Id { get; set; }
}