import { Card } from '../../../business/domain/payments/card';

export class CardRules {
    static validateCard(card?: Card | null, prefix: string = 'Card'): string[] {
        const errors: string[] = [];

        if (!card) {
            errors.push(`The ${prefix} object is required.`);
            return errors;
        }

        const number = (card.number ?? '').trim();
        const holderName = (card.holderName ?? '').trim();
        const verificationCode = (card.verificationCode ?? '').trim();
        const expiryMonth = String(card.expiryMonth ?? '').trim();
        const expiryYear = String(card.expiryYear ?? '').trim();

        if (!number) {
            errors.push(`The ${prefix}.Number field is required.`);
        } else if (!/^\d+$/.test(number)) {
            errors.push(`The ${prefix}.Number field must be a valid number.`);
        } else if (number.length > 19) {
            errors.push(`The ${prefix}.Number field must be shorter than 20 characters.`);
        }

        if (!holderName) {
            errors.push(`The ${prefix}.HolderName field is required.`);
        }

        if (!verificationCode) {
            errors.push(`The ${prefix}.VerificationCode field is required.`);
        } else if (!/^\d{3,4}$/.test(verificationCode)) {
            errors.push(`The ${prefix}.VerificationCode field must be 3 or 4 digits long.`);
        }

        if (!expiryMonth) {
            errors.push(`The ${prefix}.ExpiryMonth field is required.`);
        } else if (!/^\d+$/.test(expiryMonth)) {
            errors.push(`The ${prefix}.ExpiryMonth field must be a number.`);
        } else if (expiryMonth.length !== 2) {
            errors.push(`The ${prefix}.ExpiryMonth field must be 2 digits long.`);
        } else {
            const month = Number(expiryMonth);
            if (month < 1 || month > 12) {
                errors.push(`The ${prefix}.ExpiryMonth field must be a number between 01 and 12.`);
            }
        }

        if (!expiryYear) {
            errors.push(`The ${prefix}.ExpiryYear field is required.`);
        } else if (!/^\d+$/.test(expiryYear)) {
            errors.push(`The ${prefix}.ExpiryYear field must be a number.`);
        } else if (expiryYear.length !== 4) {
            errors.push(`The ${prefix}.ExpiryYear field must be 4 digits long.`);
        }

        if (!errors.length && expiryMonth && expiryYear) {
            if (/^\d+$/.test(expiryMonth) && /^\d+$/.test(expiryYear)) {
                if (expiryMonth.length === 2 && expiryYear.length === 4) {
                    const month = Number(expiryMonth);
                    const year = Number(expiryYear);

                    try {
                        const expiryDate = new Date(Date.UTC(year, month, 0, 23, 59, 59, 999));
                        if (expiryDate <= new Date()) {
                            errors.push('The card expiry date must be in the future.');
                        }
                    } catch {
                        errors.push('The card expiry date is invalid.');
                    }
                }
            }
        }

        return errors;
    }
}