using Business.Domain.AdditionalPaymentActions;
using Business.Domain.Enums.AdditionalPaymentActions;

namespace Presentation.Models.AdditionalPaymentActions;

public class AdditionalPaymentActionResponse
{
    public string? Id { get; set; }

    public Status? Status { get; set; }

    public StatusOutput? StatusOutput { get; set; }
}