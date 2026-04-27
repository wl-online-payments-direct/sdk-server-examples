import { HostedCheckoutSpecificOutput } from '../../../../business/domain/payments/payment-details/hosted-checkout-specific-output';
import { OperationOutput } from '../../../../business/domain/payments/payment-details/operation-output';
import { PaymentOutput } from '../../../../business/domain/payments/payment-details/payment-output';
import { PaymentStatusOutput } from '../../../../business/domain/payments/payment-details/payment-status-output';

export type GetPaymentDetailsResponse = {
    operations?: OperationOutput[] | null;
    hostedCheckoutSpecificOutput?: HostedCheckoutSpecificOutput | null;
    paymentOutput?: PaymentOutput | null;
    status?: string | null;
    statusOutput?: PaymentStatusOutput | null;
    id?: string | null;
};
