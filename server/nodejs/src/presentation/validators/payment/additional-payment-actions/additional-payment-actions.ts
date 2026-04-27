import { AdditionalPaymentActionRequest } from '../../../models/payment/additional-payment-action/additional-payment-action-request';
import { ValidationError } from '../../../../business/errors/validation-error';
import { Currency } from '../../../../business/domain/common/enums/currency';
import { EnumUtils } from '../../../utils/enum-utils';

export const AdditionalPaymentActionValidator = {
    validate(request: AdditionalPaymentActionRequest): void {
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

        if (errors.length > 0) {
            throw new ValidationError(errors);
        }
    },
};
