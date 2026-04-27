import { FastifyInstance } from 'fastify';
import { HostedCheckoutController } from './presentation/controllers/hosted-checkout';
import { PaymentLinkController } from './presentation/controllers/payment-link';
import { HostedTokenizationController } from './presentation/controllers/hosted-tokenization';
import { PaymentsController } from './presentation/controllers/payments';

export async function registerRoutes(fastify: FastifyInstance): Promise<void> {
    fastify.get('/tokens', HostedTokenizationController.getHostedTokenization);
    fastify.post('/sessions', HostedCheckoutController.createHostedCheckoutSession);
    fastify.get('/sessions/:id', HostedCheckoutController.getPaymentByHostedCheckoutId);
    fastify.post('/links', PaymentLinkController.createPaymentLink);
    fastify.post('/payments', PaymentsController.createPayment);
    fastify.post('/payments/:id/captures', PaymentsController.capturesPayment);
    fastify.post('/payments/:id/refunds', PaymentsController.refundsPayment);
    fastify.post('/payments/:id/cancels', PaymentsController.cancelsPayment);
    fastify.get('/payments/:id', PaymentsController.getPaymentDetailsById);
}
