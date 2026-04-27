import { PaymentProduct3203SpecificOutput } from './payment-product-320-specific-output';
import { PaymentProduct5001SpecificOutput } from './payment-product-5001-specific-output';
import { PaymentProduct5402SpecificOutput } from './payment-product-5402-specific-output';
import { PaymentProduct5500SpecificOutput } from './payment-product-5500-specific-output';
import { CustomerBankAccount } from './customer-bank-account';
import { FraudResults } from './fraud-results';
import { PaymentProduct840SpecificOutput } from './payment-product-840-specific-output';

export type RedirectPaymentMethodSpecificOutput = {
    authorisationCode?: string | null;
    customerBankAccount?: CustomerBankAccount | null;
    fraudResults?: FraudResults | null;
    paymentOption?: string | null;
    paymentProduct3203SpecificOutput?: PaymentProduct3203SpecificOutput | null;
    paymentProduct5001SpecificOutput?: PaymentProduct5001SpecificOutput | null;
    paymentProduct5402SpecificOutput?: PaymentProduct5402SpecificOutput | null;
    paymentProduct5500SpecificOutput?: PaymentProduct5500SpecificOutput | null;
    paymentProduct840SpecificOutput?: PaymentProduct840SpecificOutput | null;
    paymentProductId?: number | null;
    token?: string | null;
};
