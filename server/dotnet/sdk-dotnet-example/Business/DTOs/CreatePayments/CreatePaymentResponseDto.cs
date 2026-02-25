using Business.Domain.Enums.Payments;
using Business.Domain.Payments;

namespace Business.DTOs.CreatePayments;

public class CreatePaymentResponseDto
{
    public string? Id { get; init; }

    public Status? Status { get; init; }

    public StatusOutput? StatusOutput { get; init; } = new();
}