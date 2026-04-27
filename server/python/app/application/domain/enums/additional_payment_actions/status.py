from enum import Enum

class AdditionalPaymentActionStatus(str, Enum):
    CREATED = "CREATED"
    CANCELLED = "CANCELLED"
    REJECTED = "REJECTED"
    REJECTED_CAPTURE = "REJECTED_CAPTURE"
    REDIRECTED = "REDIRECTED"
    PENDING_PAYMENT = "PENDING_PAYMENT"
    PENDING_COMPLETION = "PENDING_COMPLETION"
    PENDING_CAPTURE = "PENDING_CAPTURE"
    AUTHORIZATION_REQUESTED = "AUTHORIZATION_REQUESTED"
    CAPTURE_REQUESTED = "CAPTURE_REQUESTED"
    CAPTURED = "CAPTURED"
    REVERSED = "REVERSED"
    REFUND_REQUESTED = "REFUND_REQUESTED"
    REFUNDED = "REFUNDED"

    @classmethod
    def try_from(cls, value: str):
        try:
            return cls(value.upper())
        except ValueError:
            return None