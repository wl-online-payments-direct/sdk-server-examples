import { CardFraudResults } from './card-fraud-results';
import { MobilePaymentData } from './mobile-payment-data';
import { ThreeDSecureResults } from './three-d-secure-results';

export type MobilePaymentMethodSpecificOutput = {
    authorisationCode?: string | null;
    fraudResults?: CardFraudResults | null;
    network?: string | null;
    paymentData?: MobilePaymentData | null;
    paymentProductId?: number | null;
    threeDSecureResults?: ThreeDSecureResults | null;
};
