export class ValidationError extends Error {
    readonly errors: string[];

    constructor(errors: string[]) {
        super('Validation failed.');
        this.name = 'ValidationError';
        this.errors = errors;
    }
}
