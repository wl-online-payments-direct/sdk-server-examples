import type { Domain } from 'onlinepayments-sdk-nodejs';
import { FraudResultsMapper } from './fraud-results-mapper';
import { CustomerBankAccountMapper } from './customer-bank-account-mapper';
import { PaymentProduct840SpecificOutputMapper } from './payment-product-840-specific-output-mapper';
import { PaymentProduct3203SpecificOutputMapper } from './payment-product-3203-specific-output-sdk';
import { PaymentProduct5001SpecificOutputMapper } from './payment-product-5001-specific-output-mapper';
import { PaymentProduct5402SpecificOutputMapper } from './payment-product-5402-specific-output-mapper';
import { PaymentProduct5500SpecificOutputMapper } from './payment-product-5500-specific-output-mapper';
import { RedirectPaymentMethodSpecificOutput } from '../../../business/domain/payments/payment-details/redirect-payment-method-specific-output';

type RedirectPaymentMethodSpecificOutputSdk = Domain.RedirectPaymentMethodSpecificOutput;

export const RedirectPaymentMethodSpecificOutputMapper = {
    fromSdkResponse: (
        response?: RedirectPaymentMethodSpecificOutputSdk | null,
    ): RedirectPaymentMethodSpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            token: response?.token,
            authorisationCode: response?.authorisationCode,
            paymentProductId: response?.paymentProductId,
            paymentOption: response?.paymentOption,
            fraudResults: FraudResultsMapper.fromSdkResponse(response?.fraudResults),
            customerBankAccount: CustomerBankAccountMapper.fromSdkResponse(response?.customerBankAccount),
            paymentProduct840SpecificOutput: PaymentProduct840SpecificOutputMapper.fromSdkResponse(
                response?.paymentProduct840SpecificOutput,
            ),
            paymentProduct3203SpecificOutput: PaymentProduct3203SpecificOutputMapper.fromSdkResponse(
                response?.paymentProduct3203SpecificOutput,
            ),
            paymentProduct5001SpecificOutput: PaymentProduct5001SpecificOutputMapper.fromSdkResponse(
                response?.paymentProduct5001SpecificOutput,
            ),
            paymentProduct5402SpecificOutput: PaymentProduct5402SpecificOutputMapper.fromSdkResponse(
                response?.paymentProduct5402SpecificOutput,
            ),
            paymentProduct5500SpecificOutput: PaymentProduct5500SpecificOutputMapper.fromSdkResponse(
                response?.paymentProduct5500SpecificOutput,
            ),
        };
    },
};
