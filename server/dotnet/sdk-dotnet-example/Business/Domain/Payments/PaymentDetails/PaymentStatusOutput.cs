using System.Collections.Generic;

namespace Business.Domain.Payments.PaymentDetails;

public class PaymentStatusOutput
{
    public IList<APIError>? Errors { get; set; }
    
    public bool? IsAuthorized { get; set; }

    public bool? IsCancellable { get; set; }

    public bool? IsRefundable { get; set; }

    public string? StatusCategory { get; set; }

    public int? StatusCode { get; set; }
    
    public string? StatusCodeChangeDateTime { get; set; }
}