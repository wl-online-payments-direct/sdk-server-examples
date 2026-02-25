using Business.Domain.Common.Enums;

namespace Business.DTOs.AdditionalPaymentActions;

public class AdditionalPaymentActionRequestDto
{
    public decimal Amount { get; set; }

    public Currency? Currency { get; set; }

    public bool? IsFinal { get; set; }

    public required string Id { get; set; }
}