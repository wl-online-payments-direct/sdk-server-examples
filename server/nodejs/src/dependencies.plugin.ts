import fp from 'fastify-plugin';
import { FastifyInstance } from 'fastify';
import { IHostedCheckoutClient } from './infrastructure/interfaces/hosted-checkout-client-interface';
import { IPaymentsClient } from './infrastructure/interfaces/payments-client-interface';
import { IMandateClient } from './infrastructure/interfaces/mandate-client-interface';
import { IHostedTokenizationClient } from './infrastructure/interfaces/hosted-tokenization-client-interface';
import { IPaymentLinkClient } from './infrastructure/interfaces/payment-link-client-interface';
import { IHostedCheckoutService } from './business/interfaces/hosted-checkout-service-interface';
import { IPaymentService } from './business/interfaces/payments-service-interface';
import { IHostedTokenizationService } from './business/interfaces/hosted-tokenization-service-interface';
import { IPaymentLinkService } from './business/interfaces/payment-link-service-interface';
import { IServiceClient } from './infrastructure/interfaces/service-interface';
import { createMerchantClient } from './configuration/merchant-client-configuration/merchant-client-config';
import { hostedCheckoutClient } from './infrastructure/sdk-clients/hosted-checkout-client';
import { paymentsClient } from './infrastructure/sdk-clients/payments-client';
import { mandateClient } from './infrastructure/sdk-clients/mandate-client';
import { hostedTokenizationClient } from './infrastructure/sdk-clients/hosted-tokenization-client';
import { paymentLinkClient } from './infrastructure/sdk-clients/payment-link-client';
import { serviceClient } from './infrastructure/sdk-clients/service-client';
import { HostedCheckoutService } from './business/services/hosted-checkout-service';
import { PaymentService } from './business/services/payments-service';
import { HostedTokenizationService } from './business/services/hosted-tokenization-service';
import { PaymentLinkService } from './business/services/payment-link-service';

declare module 'fastify' {
    interface FastifyRequest {
        clients: {
            hostedCheckout: IHostedCheckoutClient;
            payments: IPaymentsClient;
            mandate: IMandateClient;
            hostedTokenization: IHostedTokenizationClient;
            paymentLink: IPaymentLinkClient;
            service: IServiceClient;
        };
        services: {
            hostedCheckout: IHostedCheckoutService;
            payment: IPaymentService;
            hostedTokenization: IHostedTokenizationService;
            paymentLink: IPaymentLinkService;
        };
    }
}

async function dependenciesPlugin(fastify: FastifyInstance) {
    const merchantClient = createMerchantClient();

    const clients = {
        hostedCheckout: hostedCheckoutClient(merchantClient),
        payments: paymentsClient(merchantClient),
        mandate: mandateClient(merchantClient),
        hostedTokenization: hostedTokenizationClient(merchantClient),
        paymentLink: paymentLinkClient(merchantClient),
        service: serviceClient(merchantClient),
    };

    const services = {
        hostedCheckout: HostedCheckoutService,
        payment: PaymentService,
        hostedTokenization: HostedTokenizationService,
        paymentLink: PaymentLinkService,
    };

    fastify.decorateRequest('clients', {
        getter() {
            return clients;
        },
    });

    fastify.decorateRequest('services', {
        getter() {
            return services;
        },
    });
}

export default fp(dependenciesPlugin, {
    name: 'dependencies-plugin',
});
