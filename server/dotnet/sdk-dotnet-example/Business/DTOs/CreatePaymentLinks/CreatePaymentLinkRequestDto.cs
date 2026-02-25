using Business.Domain.Common.Enums;
using Business.Domain.Enums.PaymentLinks;
using Action = Business.Domain.Enums.PaymentLinks.Action;

namespace Business.DTOs.CreatePaymentLinks;

public class CreatePaymentLinkRequestDto
{
    public decimal? Amount { get; init; }
    
    public Currency? Currency { get; init; }

    public string? Description { get; init; }

    public ValidityPeriod? ValidFor { get; init; }

    public Action? Action { get; init; }
}