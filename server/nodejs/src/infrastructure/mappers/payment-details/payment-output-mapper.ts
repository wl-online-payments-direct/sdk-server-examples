import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentOutput } from '../../../business/domain/payments/payment-details/payment-output';
import { DiscountMapper } from './discount-mapper';
import { AmountOfMoneyMapper } from './amount-of-money-mapper';
import { CustomerOutputMapper } from './customer-output-mapper';
import { CardPaymentMethodSpecificOutputMapper } from './card-payment-method-specific-output-mapper';
import { MobilePaymentMethodSpecificOutputMapper } from './mobile-networks-specific-output-mapper';
import { SurchargeSpecificOutputMapper } from './surcharge-specific-output-mapper';
import { PaymentReferencesMapper } from './payment-references-mapper';
import { RedirectPaymentMethodSpecificOutputMapper } from './redirect-payment-method-specific-output-mapper';
import { SepaDirectDebitPaymentMethodSpecificOutputMapper } from './sepa-direct-debit-payment-method-specific-output-mapper';

type PaymentOutputSdk = Domain.PaymentOutput;

export const PaymentOutputMapper = {
    fromSdkResponse: (response?: PaymentOutputSdk | null): PaymentOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            discount: DiscountMapper.fromSdkResponse(response?.discount),
            amountOfMoney: AmountOfMoneyMapper.fromSdkResponse(response?.amountOfMoney),
            customer: CustomerOutputMapper.fromSdkResponse(response?.customer),
            paymentMethod: response?.paymentMethod,
            merchantParameters: response?.merchantParameters,
            acquiredAmount: AmountOfMoneyMapper.fromSdkResponse(response?.acquiredAmount),
            references: PaymentReferencesMapper.fromSdkResponse(response?.references),
            surchargeSpecificOutput: SurchargeSpecificOutputMapper.fromSdkResponse(response?.surchargeSpecificOutput),
            cardPaymentMethodSpecificOutput: CardPaymentMethodSpecificOutputMapper.fromSdkResponse(
                response?.cardPaymentMethodSpecificOutput,
            ),
            mobilePaymentMethodSpecificOutput: MobilePaymentMethodSpecificOutputMapper.fromSdkResponse(
                response?.mobilePaymentMethodSpecificOutput,
            ),
            redirectPaymentMethodSpecificOutput: RedirectPaymentMethodSpecificOutputMapper.fromSdkResponse(
                response?.redirectPaymentMethodSpecificOutput,
            ),
            sepaDirectDebitPaymentMethodSpecificOutput:
                SepaDirectDebitPaymentMethodSpecificOutputMapper.fromSdkResponse(
                    response?.sepaDirectDebitPaymentMethodSpecificOutput,
                ),
        };
    },
};
