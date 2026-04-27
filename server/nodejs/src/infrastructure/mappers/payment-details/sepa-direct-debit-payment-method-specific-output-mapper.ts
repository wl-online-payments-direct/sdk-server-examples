import type { Domain } from 'onlinepayments-sdk-nodejs';
import { SepaDirectDebitPaymentMethodSpecificOutput } from '../../../business/domain/payments/payment-details/sepa-direct-debit-payment-method-specific-output';
import { FraudResultsMapper } from './fraud-results-mapper';
import { PaymentProduct771SpecificOutputMapper } from './payment-product-771-specific-output-mapper';

type SepaDirectDebitPaymentMethodSpecificOutputSdk = Domain.SepaDirectDebitPaymentMethodSpecificOutput;

export const SepaDirectDebitPaymentMethodSpecificOutputMapper = {
    fromSdkResponse: (
        response?: SepaDirectDebitPaymentMethodSpecificOutputSdk | null,
    ): SepaDirectDebitPaymentMethodSpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            paymentProductId: response?.paymentProductId,
            fraudResults: FraudResultsMapper.fromSdkResponse(response?.fraudResults),
            paymentProduct771SpecificOutput: PaymentProduct771SpecificOutputMapper.fromSdkResponse(
                response?.paymentProduct771SpecificOutput,
            ),
        };
    },
};
