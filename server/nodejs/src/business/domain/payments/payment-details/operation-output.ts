import { PaymentStatusOutput } from './payment-status-output';
import { AmountOfMoney } from './amount-of-money';
import { OperationPaymentReferences } from './operation-payment-references';
import { PaymentReferences } from './payment-references';

export type OperationOutput = {
    amountOfMoney?: AmountOfMoney | null;
    id?: string | null;
    operationReferences?: OperationPaymentReferences | null;
    paymentMethod?: string | null;
    references?: PaymentReferences | null;
    status?: string | null;
    statusOutput?: PaymentStatusOutput | null;
};
