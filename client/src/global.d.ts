import type { TokenizerConstructor } from './models/Tokenizer.ts';

declare global {
    interface Window {
        Tokenizer: TokenizerConstructor;
    }
}
