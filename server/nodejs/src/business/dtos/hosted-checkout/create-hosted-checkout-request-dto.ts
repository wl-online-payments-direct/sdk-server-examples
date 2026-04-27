import { Currency } from '../../domain/common/enums/currency';
import { Language } from '../../domain/common/enums/language';
import { AddressDto } from '../common/address-dto';

export type CreateHostedCheckoutRequestDto = {
    amount?: number | null;
    currency?: Currency | null;
    language?: Language | null;
    redirectUrl?: string | null;
    billingAddress?: AddressDto | null;
    shippingAddress?: AddressDto | null;
};
