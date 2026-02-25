import './toast.scss';
import { useToast } from './ToastContext/useToast.ts';

const ToastContainer = () => {
    const { toasts, popToast } = useToast();

    return (
        <div className="wl-toast">
            {toasts.map((toast) => (
                <div key={toast.id} className={`wlp-toast wlt--${toast.variant ? toast.variant : 'info'}`}>
                    <span>{toast.message}</span>
                    <button className="wlp-close-button" onClick={() => popToast(toast.id)}>
                        &times;
                    </button>
                </div>
            ))}
        </div>
    );
};

export default ToastContainer;
