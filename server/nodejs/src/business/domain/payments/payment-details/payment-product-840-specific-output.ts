import { Address } from './address';
import { PaymentProduct840CustomerAccount } from './payment-product-840-customer-account';
import { ProtectionEligibility } from './protection-eligibility';

export type PaymentProduct840SpecificOutput = {
    billingAddress?: Address;
    customerAccount?: PaymentProduct840CustomerAccount;
    customerAddress?: Address;
    protectionEligibility?: ProtectionEligibility;
};
