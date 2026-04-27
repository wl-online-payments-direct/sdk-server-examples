import { Client, init } from 'onlinepayments-sdk-nodejs';
import dotenv from 'dotenv';
import { FastifyBaseLogger } from 'fastify';
import { ConfigurationError } from '../errors/configuration-error';

type MerchantClientConfig = {
    merchantId: string;
    apiKey: string;
    apiSecret: string;
    apiEndpoint: string;
    integrator: string;
};

export const createMerchantClient = () => {
    let sdkClient: Client | null = null;
    let merchantId: string | null = null;
    let initialized = false;

    const loadEnvironmentVariables = (): void => {
        dotenv.config();
    };

    const setupCommunicatorConfiguration = (logger?: FastifyBaseLogger): MerchantClientConfig => {
        if (
            !process.env.MERCHANT_ID ||
            !process.env.API_KEY ||
            !process.env.API_SECRET ||
            !process.env.API_ENDPOINT ||
            !process.env.INTEGRATOR
        ) {
            logger?.error('Missing required WL SDK credentials in environment.');
            throw new ConfigurationError('Missing required WL SDK credentials in environment.');
        }

        return {
            merchantId: process.env.MERCHANT_ID,
            apiKey: process.env.API_KEY,
            apiSecret: process.env.API_SECRET,
            apiEndpoint: process.env.API_ENDPOINT,
            integrator: process.env.INTEGRATOR,
        };
    };

    const setupClient = (config: MerchantClientConfig, logger?: FastifyBaseLogger): void => {
        try {
            sdkClient = init({
                integrator: config.integrator,
                host: config.apiEndpoint,
                scheme: 'https',
                port: 443,
                enableLogging: false,
                apiKeyId: config.apiKey,
                secretApiKey: config.apiSecret,
            }) as Client;

            merchantId = config.merchantId;
        } catch (error) {
            logger?.error(error, 'An error has occurred during client setup.');
            throw new ConfigurationError('An error has occurred during client setup.');
        }
    };

    const lazyInitializeSdk = (logger?: FastifyBaseLogger): void => {
        if (initialized) {
            return;
        }

        loadEnvironmentVariables();
        const config = setupCommunicatorConfiguration(logger);
        setupClient(config, logger);

        initialized = true;
    };

    return {
        getClient: (logger?: FastifyBaseLogger): Client => {
            lazyInitializeSdk(logger);
            return sdkClient!;
        },

        getMerchantId: (logger?: FastifyBaseLogger): string => {
            lazyInitializeSdk(logger);
            return merchantId!;
        },
    };
};
