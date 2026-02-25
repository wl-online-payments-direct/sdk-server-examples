using Business.Domain.AdditionalPaymentActions;
using Business.Domain.Enums.AdditionalPaymentActions;

namespace Business.DTOs.AdditionalPaymentActions;

public class AdditionalPaymentActionResponseDto
{
    public string? Id { get; set; }

    public Status? Status { get; set; }

    public StatusOutput? StatusOutput { get; set; }
}