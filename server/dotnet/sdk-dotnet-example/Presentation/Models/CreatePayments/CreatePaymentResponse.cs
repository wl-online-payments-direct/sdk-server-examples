using Business.Domain.Enums.Payments;
using Business.Domain.Payments;

namespace Presentation.Models.CreatePayments;

public class CreatePaymentResponse
{
    public string? Id { get; init; }

    public Status? Status { get; init; }

    public StatusOutput? StatusOutput { get; init; } = new();
}