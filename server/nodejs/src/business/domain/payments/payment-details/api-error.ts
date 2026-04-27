export type APIError = {
    category?: string | null;
    code?: string | null;
    errorCode?: string | null;
    httpStatusCode?: number | null;
    id?: string | null;
    message?: string | null;
    propertyName?: string | null;
    retriable?: boolean | null;
};
