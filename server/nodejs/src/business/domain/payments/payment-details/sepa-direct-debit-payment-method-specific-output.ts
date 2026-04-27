import { PaymentProduct771SpecificOutput } from './payment-product-771-specific-output';
import { FraudResults } from './fraud-results';

export type SepaDirectDebitPaymentMethodSpecificOutput = {
    fraudResults?: FraudResults | null;
    paymentProduct771SpecificOutput?: PaymentProduct771SpecificOutput | null;
    paymentProductId?: number | null;
};
