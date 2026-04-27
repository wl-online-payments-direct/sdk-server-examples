import { Currency } from '../../../business/domain/common/enums/currency';
import { AddressRules } from '../rules/address-rules';
import { ValidationError } from '../../../business/errors/validation-error';
import { Language } from '../../../business/domain/common/enums/language';
import { CreateHostedCheckoutRequest } from '../../models/hosted-checkout/create-hosted-checkout-request';
import { EnumUtils } from '../../utils/enum-utils';
import { UrlRules } from '../rules/url-rules';

export class HostedCheckoutValidator {
    static validate(request: CreateHostedCheckoutRequest): string[] {
        const errors: string[] = [];

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

        if (!request.language) {
            errors.push('The Language field is required.');
        } else if (!EnumUtils.toEnum(Language, request.language)) {
            errors.push('The Language field is invalid.');
        }

        if (!!request.redirectUrl) {
            if (!UrlRules.validate(request.redirectUrl)) {
                errors.push('The RedirectUrl field is invalid.');
            }
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

        return errors;
    }
}
