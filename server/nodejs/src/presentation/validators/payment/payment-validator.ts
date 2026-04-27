import { CreatePaymentRequest } from '../../models/payment/create-payment/create-payment-request';
import { ValidationError } from '../../../business/errors/validation-error';
import { MandateRules } from '../rules/mandate-rules';
import { PaymentMethodType } from '../../../business/domain/enums/payments/payment-method-type';
import { CardRules } from '../rules/card-rules';
import { Currency } from '../../../business/domain/common/enums/currency';
import { EnumUtils } from '../../utils/enum-utils';
import { AddressRules } from '../rules/address-rules';

export class PaymentValidator {
    static validate(request: CreatePaymentRequest): void {
        const errors: string[] = [];

        if (request.hostedTokenizationId && request.hostedTokenizationId.trim() !== '') {
            if (request.card) {
                const cardEmpty =
                    (!request.card.number || request.card.number.trim() === '') &&
                    (!request.card.holderName || request.card.holderName.trim() === '') &&
                    (!request.card.verificationCode || request.card.verificationCode.trim() === '') &&
                    (!request.card.expiryMonth || request.card.expiryMonth.trim() === '') &&
                    (!request.card.expiryYear || request.card.expiryYear.trim() === '');

                if (!cardEmpty) {
                    errors.push('If hosted tokenization id is provided, card details must not be filled.');
                }
            }
        }

        if (request.amount === undefined || request.amount === null) {
            errors.push('The Amount field is required.');
        } else if (!Number.isFinite(Number(request.amount))) {
            errors.push('The Amount field must be a number.');
        } else if (Number(request.amount) <= 0) {
            errors.push('The Amount field must be greater than zero.');
        }

        if (!request.currency) {
            errors.push('The Currency field is required.');
        } else if (!EnumUtils.toEnum(Currency, request.currency)) {
            errors.push('The Currency field is invalid.');
        }

        if (!request.method) {
            errors.push('The Method field is required.');
        } else if (!EnumUtils.toEnum(PaymentMethodType, request.method)) {
            errors.push('The Method field is invalid.');
        }

        if (EnumUtils.isInAllowedValues(PaymentMethodType, request.method, [PaymentMethodType.CREDIT_CARD])) {
            const cardErrors = CardRules.validateCard(request.card);
            errors.push(...cardErrors);
        }

        if (EnumUtils.isInAllowedValues(PaymentMethodType, request.method, [PaymentMethodType.DIRECT_DEBIT])) {
            const mandateErrors = MandateRules.validateMandate(request.mandate);
            errors.push(...mandateErrors);
        }

        if (
            request.billingAddress &&
            Object.values(request.billingAddress).some((v) => v != null && String(v).trim() !== '')
        ) {
            errors.push(...AddressRules.validateAddress(request.billingAddress, 'BillingAddress'));
        }

        if (
            request.shippingAddress &&
            Object.values(request.shippingAddress).some((v) => v != null && String(v).trim() !== '')
        ) {
            errors.push(...AddressRules.validateAddress(request.shippingAddress, 'ShippingAddress'));
        }

        if (errors.length > 0) {
            throw new ValidationError(errors);
        }
    }
}
