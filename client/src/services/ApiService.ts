import type {
    HostedCheckout,
    HostedCheckoutResponse,
    PaymentFromHostedCheckoutResponse,
} from '../models/HostedCheckout.ts';
import type { Token } from '../models/Token.ts';
import type { PaymentOutcomeResponse, PaymentResponse } from '../models/Payment.ts';
import type { PaymentLink, PaymentLinkResponse } from '../models/PaymentLink.ts';
import type { ErrorResponse } from '../models/Error.ts';
import type { HostedTokenizationPayment } from '../models/HostedTokenization.ts';
import type { CreditCardPayment } from '../models/CreditCard.ts';
import type { CreditCardDebitPayment } from '../models/CreditCardDebit.ts';
import type { AdditionalPayment, AdditionalPaymentAction } from '../models/AdditionalPayment.ts';

const API = import.meta.env.VITE_API_BASE_URL as string;

const withBase = (path: string) => (API ? `${API}${path}` : path);

const get = (url: string) => fetch(withBase(url));

const post = (url: string, data?: unknown) =>
    fetch(withBase(url), {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: data ? JSON.stringify(data) : undefined,
    });

const fetchPayment = async (id: string): Promise<PaymentOutcomeResponse> => {
    const response = await get(`/payments/${id}`);
    if (!response.ok) {
        const error: ErrorResponse = await response.json();

        throw new Error(error.description || error.message);
    }

    return response.json();
};

const fetchPaymentByHostedCheckoutId = async (id: string): Promise<PaymentFromHostedCheckoutResponse> => {
    const response = await get(`/sessions/${id}`);
    if (!response.ok) {
        const error: ErrorResponse = await response.json();

        throw new Error(error.description || error.message);
    }

    return response.json();
};

const createPayment = async (
    data: HostedTokenizationPayment | CreditCardPayment | CreditCardDebitPayment,
): Promise<PaymentResponse> => {
    const response = await post('/payments', data);
    if (!response.ok) {
        const error: ErrorResponse = await response.json();

        throw new Error(error.description || error.message);
    }

    return response.json();
};

const fetchHostedTokenization = async (): Promise<Token> => {
    const response = await get('/tokens');
    if (!response.ok) {
        const error: ErrorResponse = await response.json();

        throw new Error(error.description || error.message);
    }

    return response.json();
};

const createHostedCheckout = async (data: HostedCheckout): Promise<HostedCheckoutResponse> => {
    const response = await post('/sessions', data);
    if (!response.ok) {
        const error: ErrorResponse = await response.json();

        throw new Error(error.description || error.message);
    }

    return response.json();
};

const createPaymentLink = async (data: PaymentLink): Promise<PaymentLinkResponse> => {
    const response = await post('/links', data);
    if (!response.ok) {
        const error: ErrorResponse = await response.json();

        throw new Error(error.description || error.message);
    }

    return response.json();
};

const createAdditionalPaymentAction = async (
    id: string,
    additionalAction: AdditionalPaymentAction,
    data: AdditionalPayment,
): Promise<PaymentResponse> => {
    const response = await post(`/payments/${id}/${additionalAction}`, data);
    if (!response.ok) {
        const error: ErrorResponse = await response.json();

        throw new Error(error.description || error.message);
    }

    return response.json();
};

export default {
    createHostedCheckout,
    fetchHostedTokenization,
    fetchPayment,
    createPayment,
    createPaymentLink,
    createAdditionalPaymentAction,
    fetchPaymentByHostedCheckoutId,
};
