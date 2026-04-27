import type { Domain } from 'onlinepayments-sdk-nodejs';
import { CardPaymentMethodSpecificOutput } from '../../../business/domain/payments/payment-details/card-payment-method-specific-output';
import { CardEssentialsMapper } from './card-essentials-mapper';
import { AcquirerInformationMapper } from './acquirer-information-mapper';
import { CurrencyConversionMapper } from './conversion-currency-mapper';
import { CardFraudResultsMapper } from './card-fraud-results-mapper';
import { ExternalTokenLinkedMapper } from './external-token-linked-mapper';
import { PaymentProduct3208SpecificOutputMapper } from './payment-product-3208-specific-output-mapper';
import { PaymentProduct3209SpecificOutputMapper } from './payment-product-3209-specific-output-mapper';
import { ReattemptInstructionsMapper } from './reattempt-instructions-mapper';
import { ThreeDSecureResultsMapper } from './three-d-secure-results-mapper';

type CardPaymentMethodSpecificOutputSdk = Domain.CardPaymentMethodSpecificOutput;

export const CardPaymentMethodSpecificOutputMapper = {
    fromSdkResponse: (
        response?: CardPaymentMethodSpecificOutputSdk | null,
    ): CardPaymentMethodSpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            card: CardEssentialsMapper.fromSdkResponse(response?.card),
            acquirerInformation: AcquirerInformationMapper.fromSdkResponse(response?.acquirerInformation),
            authorisationCode: response?.authorisationCode,
            currencyConversion: CurrencyConversionMapper.fromSdkResponse(response?.currencyConversion),
            authenticatedAmount: response?.authenticatedAmount,
            fraudResults: CardFraudResultsMapper.fromSdkResponse(response?.fraudResults),
            paymentOption: response?.paymentOption,
            reattemptInstructions: ReattemptInstructionsMapper.fromSdkResponse(response?.reattemptInstructions),
            externalTokenLinked: ExternalTokenLinkedMapper.fromSdkResponse(response?.externalTokenLinked),
            paymentAccountReference: response?.paymentAccountReference,
            paymentProductId: response?.paymentProductId,
            initialSchemeTransactionId: response?.initialSchemeTransactionId,
            schemeReferenceData: response?.schemeReferenceData,
            paymentProduct3208SpecificOutput: PaymentProduct3208SpecificOutputMapper.fromSdkResponse(
                response?.paymentProduct3208SpecificOutput,
            ),
            paymentProduct3209SpecificOutput: PaymentProduct3209SpecificOutputMapper.fromSdkResponse(
                response?.paymentProduct3209SpecificOutput,
            ),
            threeDSecureResults: ThreeDSecureResultsMapper.fromSdkResponse(response?.threeDSecureResults),
            token: response?.token,
        };
    },
};
