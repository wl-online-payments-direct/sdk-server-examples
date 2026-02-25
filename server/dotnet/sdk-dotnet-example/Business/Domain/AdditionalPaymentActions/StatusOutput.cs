using Business.Domain.Common.Enums;

namespace Business.Domain.AdditionalPaymentActions;

public class StatusOutput
{
    public decimal? StatusCode { get; set; }

    public StatusCategory? StatusCategory { get; set; }
}