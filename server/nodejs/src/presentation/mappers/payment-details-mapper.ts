import { GetPaymentDetailsResponseDto } from '../../business/dtos/payment/get-payment-details/get-payment-details-response-dto';
import { GetPaymentDetailsResponse } from '../models/payment/get-payment-details/get-payment-details-response';

export const PaymentDetailsMapper = {
    fromDto: (response: GetPaymentDetailsResponseDto): GetPaymentDetailsResponse => {
        return {
            id: response.id,
            status: response.status,
            statusOutput: response.statusOutput,
            operations: response.operations,
            paymentOutput: response.paymentOutput,
            hostedCheckoutSpecificOutput: response.hostedCheckoutSpecificOutput,
        };
    },
};
