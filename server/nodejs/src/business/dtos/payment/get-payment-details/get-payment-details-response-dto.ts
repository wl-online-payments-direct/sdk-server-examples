import { OperationOutput } from '../../../domain/payments/payment-details/operation-output';
import { HostedCheckoutSpecificOutput } from '../../../domain/payments/payment-details/hosted-checkout-specific-output';
import { PaymentOutput } from '../../../domain/payments/payment-details/payment-output';
import { PaymentStatusOutput } from '../../../domain/payments/payment-details/payment-status-output';

export type GetPaymentDetailsResponseDto = {
    operations?: OperationOutput[] | null;
    hostedCheckoutSpecificOutput?: HostedCheckoutSpecificOutput | null;
    paymentOutput?: PaymentOutput | null;
    status?: string | null;
    statusOutput?: PaymentStatusOutput | null;
    id?: string | null;
};
