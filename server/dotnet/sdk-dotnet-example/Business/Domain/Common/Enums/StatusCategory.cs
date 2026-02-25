namespace Business.Domain.Common.Enums;

public enum StatusCategory
{
    CREATED = 0,
    UNSUCCESSFUL = 1,
    PENDING_PAYMENT = 2,
    PENDING_MERCHANT = 3,
    PENDING_CONNECT_OR_3RD_PARTY = 4,
    COMPLETED = 5,
    REVERSED = 6, 
    REFUNDED = 7
}