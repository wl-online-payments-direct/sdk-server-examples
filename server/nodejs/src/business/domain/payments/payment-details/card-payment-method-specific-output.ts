import { CardEssentials } from './card-essentials';
import { AcquirerInformation } from './acquirer-information';
import { CardFraudResults } from './card-fraud-results';
import { ThreeDSecureResults } from './three-d-secure-results';
import { ExternalTokenLinked } from './external-token-linked';
import { CurrencyConversion } from './currency-conversion';
import { PaymentProduct3208SpecificOutput } from './payment-produc-3208-specific-output';
import { PaymentProduct3209SpecificOutput } from './payment-product-3209-specific-output';
import { ReattemptInstructions } from './reattempt-instructions';

export type CardPaymentMethodSpecificOutput = {
    acquirerInformation?: AcquirerInformation | null;
    authorisationCode?: string | null;
    card?: CardEssentials | null;
    fraudResults?: CardFraudResults | null;
    paymentAccountReference?: string | null;
    paymentProductId?: number | null;
    threeDSecureResults?: ThreeDSecureResults | null;
    initialSchemeTransactionId?: string | null;
    schemeReferenceData?: string | null;
    token?: string | null;
    paymentOption?: string | null;
    externalTokenLinked?: ExternalTokenLinked | null;
    authenticatedAmount?: number | null;
    currencyConversion?: CurrencyConversion | null;
    paymentProduct3208SpecificOutput?: PaymentProduct3208SpecificOutput | null;
    paymentProduct3209SpecificOutput?: PaymentProduct3209SpecificOutput | null;
    reattemptInstructions?: ReattemptInstructions | null;
};
