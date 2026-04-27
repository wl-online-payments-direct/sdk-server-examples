import { SurchargeSpecificOutput } from './surcharge-specific-output';
import { AmountOfMoney } from './amount-of-money';
import { PaymentReferences } from './payment-references';
import { CustomerOutput } from './customer-output';
import { CardPaymentMethodSpecificOutput } from './card-payment-method-specific-output';
import { Discount } from './discount';
import { SepaDirectDebitPaymentMethodSpecificOutput } from './sepa-direct-debit-payment-method-specific-output';
import { RedirectPaymentMethodSpecificOutput } from './redirect-payment-method-specific-output';
import { MobilePaymentMethodSpecificOutput } from './mobile-payment-method-specific-output';

export type PaymentOutput = {
    amountOfMoney?: AmountOfMoney | null;
    references?: PaymentReferences | null;
    acquiredAmount?: AmountOfMoney | null;
    customer?: CustomerOutput | null;
    cardPaymentMethodSpecificOutput?: CardPaymentMethodSpecificOutput | null;
    paymentMethod?: string | null;
    merchantParameters?: string | null;
    discount?: Discount | null;
    surchargeSpecificOutput?: SurchargeSpecificOutput | null;
    sepaDirectDebitPaymentMethodSpecificOutput?: SepaDirectDebitPaymentMethodSpecificOutput | null;
    redirectPaymentMethodSpecificOutput?: RedirectPaymentMethodSpecificOutput | null;
    mobilePaymentMethodSpecificOutput?: MobilePaymentMethodSpecificOutput | null;
};
