import { ValidationError } from '../../../business/errors/validation-error';
import { Action } from '../../../business/domain/enums/payment-links/action';
import { ValidFor } from '../../../business/domain/enums/payment-links/validity-period';
import { Currency } from '../../../business/domain/common/enums/currency';
import { CreatePaymentLinkRequest } from '../../models/payment-link/create-payment-link-request';
import { EnumUtils } from '../../utils/enum-utils';

export class PaymentLinkValidator {
    static validate(request: CreatePaymentLinkRequest): string[] {
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

        if (request.description !== undefined && request.description !== null) {
            if (request.description.length > 1000) {
                errors.push('The Description field must be shorter than 1000 characters.');
            }
        }

        if (request.validFor === null || request.validFor === undefined) {
            errors.push('The ValidFor field is required.');
        } else {
            const validForStr = String(request.validFor);

            if (isNaN(Number(validForStr))) {
                errors.push('The ValidFor field is invalid.');
            } else if (!EnumUtils.toEnum(ValidFor, validForStr)) {
                errors.push(
                    'The ValidFor field is invalid and must be a number from the following set: 24, 48, 336, 720.',
                );
            }
        }

        if (!request.action) {
            errors.push('The Action field is required.');
        } else if (!EnumUtils.toEnum(Action, request.action)) {
            errors.push('The Action field is invalid.');
        }

        if (errors.length > 0) {
            throw new ValidationError(errors);
        }

        return errors;
    }
}
