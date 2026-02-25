namespace Business.Domain.Enums.AdditionalPaymentActions;

public enum Status
{
    CREATED = 0, 
    CANCELLED = 1, 
    REJECTED = 2, 
    REJECTED_CAPTURE = 3, 
    REDIRECTED = 4, 
    PENDING_PAYMENT = 5, 
    PENDING_COMPLETION = 6, 
    PENDING_CAPTURE = 7, 
    AUTHORIZATION_REQUESTED = 8, 
    CAPTURE_REQUESTED = 9, 
    CAPTURED = 10, 
    REVERSED = 11, 
    REFUND_REQUESTED = 12, 
    REFUNDED = 13
}