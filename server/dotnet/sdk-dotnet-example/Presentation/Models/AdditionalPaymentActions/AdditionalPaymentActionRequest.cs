using Business.Domain.Common.Enums;

namespace Presentation.Models.AdditionalPaymentActions;

public class AdditionalPaymentActionRequest
{
    public decimal Amount { get; set; }

    public Currency? Currency { get; set; }
    
    public bool? IsFinal { get; set; }
}