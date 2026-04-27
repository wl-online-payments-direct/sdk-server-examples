import type { Domain } from 'onlinepayments-sdk-nodejs';
import { OperationOutput } from '../../../business/domain/payments/payment-details/operation-output';
import { AmountOfMoneyMapper } from './amount-of-money-mapper';
import { OperationPaymentReferencesMapper } from './operation-payment-references-mapper';
import { PaymentStatusOutputMapper } from './payment-status-output-mapper';
import { PaymentReferencesMapper } from './payment-references-mapper';

type OperationOutputSdk = Domain.OperationOutput;

export const OperationOutputMapper = {
    fromSdkResponse: (response?: OperationOutputSdk | null): OperationOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            id: response?.id,
            operationReferences: OperationPaymentReferencesMapper.fromSdkResponse(response?.operationReferences),
            paymentMethod: response?.paymentMethod,
            statusOutput: PaymentStatusOutputMapper.fromSdkResponse(response?.statusOutput),
            amountOfMoney: AmountOfMoneyMapper.fromSdkResponse(response?.amountOfMoney),
            references: PaymentReferencesMapper.fromSdkResponse(response?.references),
            status: response?.status,
        };
    },
};
