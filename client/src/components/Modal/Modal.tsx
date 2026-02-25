import { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import './modal.scss';
import type { PaymentOutcomeResponse } from '../../models/Payment.ts';

type Props = {
    title: string;
    payment?: PaymentOutcomeResponse;
    onClose?: () => void;
};

const Modal = ({ title, payment, onClose }: Props) => {
    const [modalRoot, setModalRoot] = useState<HTMLElement | null>(null);

    useEffect(() => {
        const root = document.getElementById('modal-root');
        setModalRoot(root);
    }, []);

    if (!modalRoot) {
        return null;
    }

    return ReactDOM.createPortal(
        <div className="wl-modal" onClick={onClose}>
            <div className="wlp-content" onClick={(e) => e.stopPropagation()}>
                <button className="wlp-close-button" onClick={onClose} />
                <label>{title}</label>
                <textarea id="outcome-response" readOnly>
                    {JSON.stringify(payment, null, 2)}
                </textarea>
            </div>
        </div>,
        modalRoot,
    );
};

export default Modal;
