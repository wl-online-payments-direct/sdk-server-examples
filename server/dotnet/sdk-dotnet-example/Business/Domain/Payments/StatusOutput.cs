using Business.Domain.Common.Enums;
using Business.Domain.Enums.Payments;

namespace Business.Domain.Payments;

public class StatusOutput
{
    public int? StatusCode { get; set; }

    public StatusCategory? StatusCategory { get; set; }
}