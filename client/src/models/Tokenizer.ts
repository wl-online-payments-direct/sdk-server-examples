export type TokenizerError = {
    message?: string;
};

export type TokenizerResult = {
    success: boolean;
    hostedTokenizationId: string;
    error?: TokenizerError;
};

export type TokenizerInstance = {
    initialize: () => Promise<void>;
    submitTokenization: () => Promise<TokenizerResult>;
    destroy: () => void;
};

export type TokenizerConstructor = new (arg1: unknown, arg2: string, options: unknown) => TokenizerInstance;
