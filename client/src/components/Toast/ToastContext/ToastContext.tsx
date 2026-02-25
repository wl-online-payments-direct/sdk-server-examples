import { createContext, type ReactNode, useCallback, useState } from 'react';
import CryptingUtility from '../../../utils/CryptingUtility.ts';

type ToastVariant = 'error' | 'info' | 'warning';

type Toast = {
    id: string;
    message: string;
    variant?: ToastVariant;
};

type ToastContextType = {
    pushToast: (message: string, variant?: ToastVariant) => void;
    popToast: (id: string) => void;
    toasts: Toast[];
};

export const ToastContext = createContext<ToastContextType | undefined>(undefined);

const MAX_TOASTS = 5;
const TOAST_TIMEOUT = 5000;

export const ToastProvider = ({ children }: { children: ReactNode }) => {
    const [toasts, setToasts] = useState<Toast[]>([]);

    const popToast = useCallback((id: string) => {
        setToasts((prev) => prev.filter((toast) => toast.id !== id));
    }, []);

    const pushToast = useCallback(
        (message: string, variant: ToastVariant = 'info') => {
            const id = CryptingUtility.generateRandomString();

            setToasts((prev) => {
                const newToasts = prev.length >= MAX_TOASTS ? prev.slice(1) : prev;
                return [...newToasts, { id, message, variant }];
            });

            setTimeout(() => popToast(id), TOAST_TIMEOUT);
        },
        [popToast],
    );

    return <ToastContext.Provider value={{ pushToast, popToast, toasts }}>{children}</ToastContext.Provider>;
};
