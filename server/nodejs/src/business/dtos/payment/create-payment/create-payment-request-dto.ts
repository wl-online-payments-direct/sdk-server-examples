import { Currency } from '../../../domain/common/enums/currency';
import { PaymentMethodType } from '../../../domain/enums/payments/payment-method-type';
import { AddressDto } from '../../common/address-dto';
import { Card } from '../../../domain/payments/card';
import { Mandate } from '../../../domain/payments/mandate';

export type CreatePaymentRequestDto = {
    amount?: number | null;
    currency?: Currency | null;
    method?: PaymentMethodType | null;
    hostedTokenizationId?: string | null;
    shippingAddress?: AddressDto | null;
    billingAddress?: AddressDto | null;
    card?: Card | null;
    mandate?: Mandate | null;
    paymentProductId?: number | null;
};
