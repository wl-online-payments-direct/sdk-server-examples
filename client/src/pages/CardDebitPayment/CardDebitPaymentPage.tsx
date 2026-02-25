import { type FormEvent, useEffect, useState } from 'react';
import '../../styles/form.scss';
import { useToast } from '../../components/Toast/ToastContext/useToast.ts';
import ApiService from '../../services/ApiService.ts';
import AmountUtility from '../../utils/AmountUtility.ts';
import ValidationUtility from '../../utils/ValidationUtility.ts';
import Input from '../../components/Input/Input.tsx';
import Select from '../../components/Select/Select.tsx';
import Modal from '../../components/Modal/Modal.tsx';
import AddressForm from '../../components/AddressForm/AddressForm.tsx';
import { COUNTRY_OPTIONS, CURRENCY_OPTIONS, RECURRENCE_TYPES, SIGNATURE_TYPES } from '../../utils/constants.ts';
import translations from '../../translations/translations.ts';
import type { Mandate } from '../../models/Mandate.ts';
import type { Address } from '../../models/Address.ts';
import type { PaymentOutcomeResponse } from '../../models/Payment.ts';

type FormModel = {
    amount: string;
    currency: string;
};

type FormError = {
    amount: boolean;
    currency: boolean;
    customerReference: boolean;
    recurrenceType: boolean;
    signatureType: boolean;
};

const FormDetailsInitialState = {
    amount: '',
    currency: CURRENCY_OPTIONS[0].value,
};

const AddressesInitialState = {
    firstName: '',
    lastName: '',
    country: COUNTRY_OPTIONS[0].value,
    city: '',
    zip: '',
    street: '',
};

const MandateInitialState = {
    iban: '',
    customerReference: '',
    mandateReference: '',
    recurrenceType: RECURRENCE_TYPES[0].value,
    signatureType: SIGNATURE_TYPES[0].value,
    returnUrl: '',
};

const FormErrorInitialState = {
    amount: false,
    currency: false,
    customerReference: false,
    recurrenceType: false,
    signatureType: false,
};

const CardDebitPaymentPage = () => {
    const { pushToast } = useToast();

    const [model, setModel] = useState<Partial<FormModel>>({
        ...FormDetailsInitialState,
    });

    const [mandate, setMandate] = useState<Partial<Mandate>>({
        ...MandateInitialState,
        address: { ...AddressesInitialState },
    });

    const [formErrors, setFormErrors] = useState<FormError>({ ...FormErrorInitialState });

    const [paymentId, setPaymentId] = useState('');
    const [payment, setPayment] = useState<PaymentOutcomeResponse>();
    const [isModalOpen, setIsModalOpen] = useState(false);

    useEffect(() => {
        if (!paymentId) {
            return;
        }

        ApiService.fetchPayment(paymentId)
            .then((response) => {
                setPayment(response);
                setIsModalOpen((prev) => !prev);
            })
            .catch((error) => pushToast(error, 'error'));
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [paymentId]);

    const handleChangeModel = (value: string, prop: keyof FormModel) => {
        setModel((prev) => ({
            ...prev,
            [prop]: value,
        }));

        setFormErrors?.((prev) => ({
            ...prev,
            [prop]: false,
        }));
    };

    const handleChangeMandate = (value: string | Address, prop: keyof Mandate) => {
        setMandate((prev) => ({
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

        const isRecurrenceInvalid = ValidationUtility.isEmpty(mandate.recurrenceType);
        const isCustomerReferenceInvalid = ValidationUtility.isEmpty(mandate.customerReference);
        const isSignatureTypeInvalid = ValidationUtility.isEmpty(mandate.signatureType);

        setFormErrors((previousState) => {
            return {
                ...previousState,
                amount: isAmountInvalid,
                currency: isCurrencyInvalid,
                recurrenceType: isRecurrenceInvalid,
                customerReference: isCustomerReferenceInvalid,
                signatureType: isSignatureTypeInvalid,
            };
        });

        return true;
    };

    const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault();

        if (!isFormValid()) {
            return;
        }

        ApiService.createPayment({
            ...(model as FormModel),
            amount: AmountUtility.parseAmount(model.amount ?? ''),
            mandate: { ...(mandate as Mandate) },
            method: 'DIRECT_DEBIT',
        })
            .then((response) => {
                setPaymentId(response.id);
            })
            .catch((error) => {
                pushToast(error.message, 'error');
            });
    };

    const handleCloseModal = () => {
        window.location.reload();
    };

    return (
        <>
            <form className="wl-form wlv--padding-uniform" onSubmit={handleSubmit} noValidate>
                <div className="wlp-header">
                    <h1>{translations.create_direct_debit_payment}</h1>
                </div>
                <div className="wlp-container">
                    <Input
                        value={mandate.iban ?? ''}
                        onChange={(e) => handleChangeMandate(e, 'iban')}
                        label={translations.iban}
                    />
                    <div className="wlp-details">
                        <Input
                            value={mandate.customerReference ?? ''}
                            onChange={(e) => handleChangeMandate(e, 'customerReference')}
                            label={translations.customer_reference}
                            className={`${formErrors.customerReference ? 'wls--error' : ''}`}
                        />
                        <Input
                            value={mandate.mandateReference ?? ''}
                            onChange={(e) => handleChangeMandate(e, 'mandateReference')}
                            label={translations.mandate_reference}
                        />
                    </div>
                    <div className="wlp-details">
                        <Select
                            value={mandate.recurrenceType ?? ''}
                            options={RECURRENCE_TYPES}
                            onChange={(e) => handleChangeMandate(e, 'recurrenceType')}
                            label={translations.recurrence_type}
                            className={`${formErrors.recurrenceType ? 'wls--error' : ''}`}
                        />
                        <Select
                            value={mandate.signatureType ?? ''}
                            options={SIGNATURE_TYPES}
                            onChange={(e) => handleChangeMandate(e, 'signatureType')}
                            label={translations.signature_type}
                            className={`${formErrors.signatureType ? 'wls--error' : ''}`}
                        />
                    </div>
                    <Input
                        value={mandate.returnUrl ?? ''}
                        onChange={(e) => handleChangeMandate(e, 'returnUrl')}
                        label={translations.return_url}
                    />
                    <div className="wlp-details">
                        <Input
                            value={model.amount ?? ''}
                            onChange={(e) => handleChangeModel(e, 'amount')}
                            label={translations.amount}
                            className={`${formErrors.amount ? 'wls--error' : ''}`}
                            hasNumericMask
                        />
                        <Select
                            value={model.currency}
                            options={CURRENCY_OPTIONS}
                            label={translations.currency}
                            onChange={(e) => handleChangeModel(e, 'currency')}
                            className={`${formErrors.currency ? 'wls--error' : ''}`}
                        />
                    </div>
                    <AddressForm
                        title={translations.mandate_address}
                        model={mandate.address}
                        onChange={(e) => handleChangeMandate(e, 'address')}
                    />
                </div>
                <div className="wlp-button">
                    <button type="submit">{translations.create_payment}</button>
                </div>
            </form>
            {isModalOpen && (
                <Modal title={translations.payment_successful} onClose={handleCloseModal} payment={payment} />
            )}
        </>
    );
};

export default CardDebitPaymentPage;
