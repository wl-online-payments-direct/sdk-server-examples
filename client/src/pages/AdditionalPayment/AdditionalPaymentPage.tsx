import { type FormEvent, useEffect, useState } from 'react';
import { useToast } from '../../components/Toast/ToastContext/useToast.ts';
import Input from '../../components/Input/Input.tsx';
import Select from '../../components/Select/Select.tsx';
import Modal from '../../components/Modal/Modal.tsx';
import RadioGroup from '../../components/RadioGroup/RadioGroup.tsx';
import AmountUtility from '../../utils/AmountUtility.ts';
import ValidationUtility from '../../utils/ValidationUtility.ts';
import ApiService from '../../services/ApiService.ts';
import translations from '../../translations/translations.ts';
import type { AdditionalPaymentAction } from '../../models/AdditionalPayment.ts';
import type { PaymentOutcomeResponse } from '../../models/Payment.ts';
import { ADDITIONAL_PAYMENT_ACTIONS, CURRENCY_OPTIONS, IS_FINAL_OPTIONS } from '../../utils/constants.ts';

type FormModel = {
    amount: string;
    currency: string;
    isFinal: string;
    action?: AdditionalPaymentAction;
    paymentId: string;
};

const FormDetailsInitialState = {
    amount: '',
    currency: CURRENCY_OPTIONS[0].value,
    isFinal: IS_FINAL_OPTIONS[0].value,
    paymentId: '',
    action: ADDITIONAL_PAYMENT_ACTIONS[0].value,
};

type FormError = {
    amount: boolean;
    currency: boolean;
    paymentId: boolean;
    action: boolean;
};

const AdditionalPaymentPage = () => {
    const { pushToast } = useToast();

    const [model, setModel] = useState<Partial<FormModel>>({
        ...FormDetailsInitialState,
    });

    const [formErrors, setFormErrors] = useState<FormError>({
        amount: false,
        currency: false,
        paymentId: false,
        action: false,
    });

    const [payment, setPayment] = useState<PaymentOutcomeResponse>();
    const [paymentId, setPaymentId] = useState('');

    const [isModalOpen, setIsModalOpen] = useState(false);

    const modalTitle =
        model.action === 'cancels'
            ? translations.cancel_successful
            : model.action === 'refunds'
              ? translations.refund_successful
              : translations.capture_successful;

    useEffect(() => {
        if (!paymentId) {
            return;
        }

        ApiService.fetchPayment(paymentId)
            .then((response) => {
                setPayment(response);
                setIsModalOpen(true);
            })
            .catch((error) => pushToast(error, 'error'));
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [paymentId]);

    const handleChange = (value: string, prop: keyof FormModel) => {
        setModel((prev) => ({
            ...prev,
            [prop]: value,
        }));

        setFormErrors?.((prev) => ({
            ...prev,
            [prop]: false,
        }));
    };

    const isFormValid = () => {
        const parsedAmount = AmountUtility.parseAmount(model.amount ?? '');

        const isCurrencyInvalid = ValidationUtility.isEmpty(model.currency);
        const isAmountInvalid =
            ValidationUtility.isEmpty(model.amount) || ValidationUtility.isSmallerOrEqualToZero(parsedAmount);

        const isPaymentIdInvalid = ValidationUtility.isEmpty(model.paymentId);
        const isActionInvalid = ValidationUtility.isEmpty(model.action);

        setFormErrors((previousState) => {
            return {
                ...previousState,
                amount: isAmountInvalid,
                currency: isCurrencyInvalid,
                paymentId: isPaymentIdInvalid,
                action: isActionInvalid,
            };
        });

        return true;
    };

    const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault();

        if (!isFormValid()) {
            return;
        }

        ApiService.createAdditionalPaymentAction(model.paymentId!, model.action!, {
            isFinal: model.isFinal === IS_FINAL_OPTIONS[0].value,
            currency: model.currency!,
            amount: AmountUtility.parseAmount(model.amount ?? ''),
        })
            .then((data) => {
                setPaymentId(data.id);
            })
            .catch((error) => {
                pushToast(error.message, 'error');
            });
    };

    const handleModalClose = () => {
        setIsModalOpen(false);
        window.location.reload();
    };

    return (
        <>
            <form className="wl-form wlv--padding-uniform" onSubmit={handleSubmit}>
                <div className="wlp-header">
                    <h1>{translations.additional_payment_action}</h1>
                </div>
                <div className="wlp-container">
                    <Select
                        value={model.action}
                        options={ADDITIONAL_PAYMENT_ACTIONS}
                        label={translations.action}
                        onChange={(e) => handleChange(e, 'action')}
                        className={`${formErrors.action ? 'wls--error' : ''}`}
                    />
                    <Input
                        value={model.paymentId ?? ''}
                        onChange={(e) => handleChange(e, 'paymentId')}
                        label={translations.payment_id}
                        className={`${formErrors.paymentId ? 'wls--error' : ''}`}
                    />
                    <div className="wlp-details">
                        <Input
                            value={model.amount ?? ''}
                            onChange={(e) => handleChange(e, 'amount')}
                            label={translations.amount}
                            className={`${formErrors.amount ? 'wls--error' : ''}`}
                            hasNumericMask
                        />
                        <Select
                            value={model.currency}
                            options={CURRENCY_OPTIONS}
                            label={translations.currency}
                            onChange={(e) => handleChange(e, 'currency')}
                            className={`${formErrors.currency ? 'wls--error' : ''}`}
                        />
                    </div>
                    <RadioGroup
                        selectedValue={model.isFinal!}
                        onChange={(e) => handleChange(e, 'isFinal')}
                        name="isFinal"
                        title={translations.is_final}
                        options={IS_FINAL_OPTIONS}
                    />
                </div>
                <div className="wlp-button">
                    <button type="submit">{translations.execute}</button>
                </div>
            </form>
            {isModalOpen && <Modal onClose={handleModalClose} title={modalTitle} payment={payment} />}
        </>
    );
};

export default AdditionalPaymentPage;
