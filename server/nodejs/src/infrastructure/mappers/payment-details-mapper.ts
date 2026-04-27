import type { Domain } from 'onlinepayments-sdk-nodejs';
import { GetPaymentDetailsResponseDto } from '../../business/dtos/payment/get-payment-details/get-payment-details-response-dto';
import { OperationOutput } from '../../business/domain/payments/payment-details/operation-output';
import { PaymentStatusOutputMapper } from './payment-details/payment-status-output-mapper';
import { PaymentOutputMapper } from './payment-details/payment-output-mapper';
import { HostedCheckoutSpecificOutputMapper } from './payment-details/hosted-checkout-specific-output-mapper';
import { OperationOutputMapper } from './payment-details/operation-output-mapper';

type PaymentDetailsResponseSdk = Domain.PaymentDetailsResponse;
type OperationOutputSdk = Domain.OperationOutput;

export const PaymentDetailsMapper = {
    fromSdkResponse: (response?: PaymentDetailsResponseSdk | null): GetPaymentDetailsResponseDto => {
        return {
            statusOutput: PaymentStatusOutputMapper.fromSdkResponse(response?.statusOutput),
            paymentOutput: PaymentOutputMapper.fromSdkResponse(response?.paymentOutput),
            status: response?.status,
            hostedCheckoutSpecificOutput: HostedCheckoutSpecificOutputMapper.fromSdkResponse(
                response?.hostedCheckoutSpecificOutput,
            ),
            id: response?.id,
            operations: mapList(response?.Operations),
        };
    },
};

const mapList = (operations?: OperationOutputSdk[] | null): OperationOutput[] | undefined => {
    return operations
        ?.map((op) => OperationOutputMapper.fromSdkResponse(op))
        .filter((op): op is OperationOutput => !!op);
};
