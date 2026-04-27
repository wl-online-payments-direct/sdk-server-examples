import Fastify from 'fastify';
import cors from '@fastify/cors';
import 'dotenv/config';
import { registerRoutes } from './routes';
import { globalErrorHandler } from './presentation/middleware/global-error-handler';
import dependenciesPlugin from './dependencies.plugin';

const PORT = parseInt(process.env.PORT || '3000');

async function start(): Promise<void> {
    const fastify = Fastify({
        logger: {
            level: 'info',
            base: null,
            timestamp: () => `"time":"${new Date().toLocaleTimeString()}"`,
            messageKey: 'message',
            formatters: {
                level() {
                    return {};
                },
            },
        },
        disableRequestLogging: true,
    });

    await fastify.register(cors, {
        origin: process.env.CORS_ORIGIN,
        methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
        allowedHeaders: ['Content-Type', 'Authorization', 'X-Requested-With'],
        credentials: true,
    });

    fastify.setErrorHandler(globalErrorHandler);

    await fastify.register(dependenciesPlugin);
    await registerRoutes(fastify);

    await fastify.listen({ port: PORT, host: '0.0.0.0' });
}

start().catch((err) => {
    console.error('Failed to start server:', err);
    process.exit(1);
});
