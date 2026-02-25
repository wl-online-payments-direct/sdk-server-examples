import { type FormEvent, useState } from 'react';
import '../../styles/form.scss';
import '../../styles/section.scss';
import { useToast } from '../../components/Toast/ToastContext/useToast.ts';
import AmountUtility from '../../utils/AmountUtility.ts';
import ValidationUtility from '../../utils/ValidationUtility.ts';
import ApiService from '../../services/ApiService.ts';
import Input from '../../components/Input/Input.tsx';
import Select from '../../components/Select/Select.tsx';
import { CURRENCY_OPTIONS, VALID_FOR_OPTIONS } from '../../utils/constants.ts';
import translations from '../../translations/translations.ts';
import type { PaymentLinkAction } from '../../models/PaymentLink.ts';

const InitialState = {
    amount: '',
    currency: CURRENCY_OPTIONS[0].value,
    description: '',
    validFor: VALID_FOR_OPTIONS[0].value,
    action: 'PREVIEW' as PaymentLinkAction,
};

type Form = {
    amount: string;
    currency: string;
    description?: string;
    validFor: string;
    action: PaymentLinkAction;
};

const PaymentLinkPage = () => {
    const { pushToast } = useToast();

    const [model, setModel] = useState<Partial<Form>>({ ...InitialState });
    const [paymentLink, setPaymentLink] = useState('');

    const [formErrors, setFormErrors] = useState({
        amount: false,
        currency: false,
        validFor: false,
    });

    const handleChange = (value: string | PaymentLinkAction, prop: keyof Form) => {
        setModel((prev) => ({
            ...prev,
            [prop]: value,
        }));

        setFormErrors?.((prev) => ({
            ...prev,
            [prop]: false,
        }));
    };

    const handleCopyPaymentLink = () => {
        navigator.clipboard
            .writeText(paymentLink)
            .then(() => {
                pushToast(translations.link_copied_to_clipboard);
            })
            .catch((error) => {
                console.error(error);
            });
    };

    const isFormValid = () => {
        const parsedAmount = AmountUtility.parseAmount(model.amount ?? '');

        const isCurrencyInvalid = ValidationUtility.isEmpty(model.currency);
        const isValidForInvalid = ValidationUtility.isEmpty(model.validFor);
        const isAmountInvalid =
            ValidationUtility.isEmpty(model.amount) || ValidationUtility.isSmallerOrEqualToZero(parsedAmount);

        setFormErrors((previousState) => {
            return {
                ...previousState,
                amount: isAmountInvalid,
                currency: isCurrencyInvalid,
                validFor: isValidForInvalid,
            };
        });

        return true;
    };

    const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault();

        if (!isFormValid()) {
            return;
        }

        ApiService.createPaymentLink({
            ...(model as Form),
            amount: AmountUtility.parseAmount(model.amount ?? ''),
        })
            .then((data) => {
                if (model.action === 'PREVIEW') {
                    window.open(data.redirectUrl, '_blank', 'noopener,noreferrer');
                } else {
                    setPaymentLink(data.redirectUrl);
                }
            })
            .catch((error) => {
                pushToast(error.message, 'error');
            });
    };

    return (
        <>
            <form className="wl-form wlv--padding-uniform" onSubmit={handleSubmit}>
                <div className="wlp-header">
                    <h1>{translations.create_payment_link}</h1>
                </div>
                <div className="wlp-container">
                    <div className="wlp-details">
                        <Input
                            value={model.amount}
                            onChange={(e) => handleChange(e, 'amount')}
                            label={translations.amount}
                            className={`${formErrors.amount ? 'wls--error' : ''}`}
                            hasNumericMask
                        />
                        <Select
                            value={model.currency}
                            onChange={(e) => handleChange(e, 'currency')}
                            options={CURRENCY_OPTIONS}
                            label={translations.currency}
                            className={`${formErrors.currency ? 'wls--error' : ''}`}
                        />
                    </div>
                    <Input
                        value={model.description}
                        label={translations.description}
                        onChange={(e) => handleChange(e, 'description')}
                    />
                    <Select
                        value={model.validFor}
                        onChange={(e) => handleChange(e, 'validFor')}
                        options={VALID_FOR_OPTIONS}
                        label={translations.valid_for}
                        className={`${formErrors.validFor ? 'wls--error' : ''}`}
                    />
                </div>
                <div className="wlp-button">
                    <button type="submit" onClick={() => handleChange('PREVIEW', 'action')}>
                        {translations.preview}
                    </button>
                    <button type="submit" onClick={() => handleChange('CREATE', 'action')}>
                        {translations.copy_payment_link}
                    </button>
                </div>
            </form>
            {paymentLink && (
                <div className="wl-section">
                    <label className="wlp-header">{translations.payment_link_successfully_created}</label>
                    <div className="wlp-content">
                        <Input value={paymentLink} />
                        <button onClick={handleCopyPaymentLink}>{translations.copy}</button>
                    </div>
                </div>
            )}
        </>
    );
};

export default PaymentLinkPage;
