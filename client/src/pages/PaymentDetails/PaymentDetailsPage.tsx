import '../../styles/form.scss';
import translations from '../../translations/translations.ts';
import { useEffect, useState } from 'react';
import ApiService from '../../services/ApiService.ts';
import type { PaymentOutcomeResponse } from '../../models/Payment.ts';
import { useToast } from '../../components/Toast/ToastContext/useToast.ts';
import Modal from '../../components/Modal/Modal.tsx';

const PaymentDetailsPage = () => {
    const { pushToast } = useToast();
    const [hostedCheckoutId, setHostedCheckoutId] = useState('');
    const [payment, setPayment] = useState<PaymentOutcomeResponse>();
    const [isModalOpen, setIsModalOpen] = useState(false);

    const handleModalClose = () => {
        setIsModalOpen(false);
    };

    useEffect(() => {
        setHostedCheckoutId(localStorage.getItem('hostedCheckoutId') || '');

        if (hostedCheckoutId) {
            ApiService.fetchPaymentByHostedCheckoutId(hostedCheckoutId)
                .then((response) => {
                    if (response.paymentId) {
                        ApiService.fetchPayment(response.paymentId)
                            .then((paymentResponse) => {
                                setPayment(paymentResponse);
                                setIsModalOpen(false);
                            })
                            .catch((error) => pushToast(error, 'error'));
                    }
                })
                .catch((error) => pushToast(error, 'error'));
        }
    }, [hostedCheckoutId, pushToast]);

    const handleShowPaymentDetails = () => {
        setIsModalOpen(true);
    };

    return (
        <>
            <form className="wl-form wlv--padding-uniform">
                <div className="wlp-header">
                    <h1>{translations.payment_details}</h1>
                    <div className="wlp-button">
                        <button type="button" onClick={handleShowPaymentDetails}>
                            {translations.show_payment_details}
                        </button>
                    </div>
                </div>
                <div className="wlp-container">
                    <div className="wlp-details"></div>
                </div>
            </form>
            {isModalOpen && (
                <Modal onClose={handleModalClose} title={translations.payment_successful} payment={payment} />
            )}
        </>
    );
};

export default PaymentDetailsPage;
