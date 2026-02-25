import { type FormEvent, useEffect, useState } from 'react';
import '../../styles/form.scss';
import ApiService from '../../services/ApiService.ts';
import AmountUtility from '../../utils/AmountUtility.ts';
import ValidationUtility from '../../utils/ValidationUtility.ts';
import Input from '../../components/Input/Input.tsx';
import Select from '../../components/Select/Select.tsx';
import CheckBox from '../../components/CheckBox/CheckBox.tsx';
import Modal from '../../components/Modal/Modal.tsx';
import AddressForm from '../../components/AddressForm/AddressForm.tsx';
import type { Address } from '../../models/Address.ts';
import {
    COUNTRY_OPTIONS,
    CURRENCY_OPTIONS,
    LANGUAGE_OPTIONS,
    MONTH_OPTIONS,
    YEAR_OPTIONS,
} from '../../utils/constants.ts';
import translations from '../../translations/translations.ts';
import { useToast } from '../../components/Toast/ToastContext/useToast.ts';
import type { CreditCard } from '../../models/CreditCard.ts';

const MAX_LENGTH_CARD_NUMBER = 19;
const MIN_LENGTH_VERIFICATION_CODE = 3;
const MAX_LENGTH_VERIFICATION_CODE = 4;

type FormDetails = {
    amount: string;
    currency: string;
};

type FormError = {
    amount: boolean;
    currency: boolean;
    number: boolean;
    holderName: boolean;
    verificationCode: boolean;
    expiryMonth: boolean;
    expiryYear: boolean;
};

type FormModel = FormDetails & {
    shippingAddress?: Address;
    billingAddress?: Address;
};

const FormDetailsInitialState = {
    amount: '',
    currency: CURRENCY_OPTIONS[0].value,
    language: LANGUAGE_OPTIONS[0].value,
    redirectUrl: '',
};

const AddressesInitialState = {
    firstName: '',
    lastName: '',
    country: COUNTRY_OPTIONS[0].value,
    city: '',
    zip: '',
    street: '',
};

const CreditCardInitialState = {
    number: '',
    holderName: '',
    verificationCode: '',
    expiryMonth: MONTH_OPTIONS[0].value,
    expiryYear: YEAR_OPTIONS[0].value,
};

const FormErrorInitialState = {
    amount: false,
    currency: false,
    number: false,
    holderName: false,
    verificationCode: false,
    expiryMonth: false,
    expiryYear: false,
};

const CardPaymentPage = () => {
    const { pushToast } = useToast();

    const [model, setModel] = useState<Partial<FormModel>>({
        ...FormDetailsInitialState,
        shippingAddress: { ...AddressesInitialState },
        billingAddress: { ...AddressesInitialState },
    });

    const [creditCard, setCreditCard] = useState<CreditCard>({ ...CreditCardInitialState });

    const [useShippingAddress, setUseShippingAddress] = useState(true);

    const [formErrors, setFormErrors] = useState<FormError>({ ...FormErrorInitialState });

    const [paymentId, setPaymentId] = useState('');
    const [payment, setPayment] = useState<Record<string, unknown>>();

    const [isModalOpen, setIsModalOpen] = useState(false);

    useEffect(() => {
        if (!paymentId) {
            return;
        }

        ApiService.fetchPayment(paymentId)
            .then((response) => {
                setPayment(response);
                setIsModalOpen(true);
            })
            .catch((error) => {
                pushToast(error.message, 'error');
            });
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [paymentId]);

    const handleChangeModel = (value: string | Address, prop: keyof FormModel) => {
        setModel((prev) => ({
            ...prev,
            [prop]: value,
        }));

        setFormErrors?.((prev) => ({
            ...prev,
            [prop]: false,
        }));
    };

    const handleChangeCreditCard = (value: string, prop: keyof CreditCard) => {
        setCreditCard((prev) => ({
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

        const isCreditCardNumberInvalid =
            ValidationUtility.isEmpty(creditCard.number) ||
            !ValidationUtility.hasOnlyNumbersAndSpaces(creditCard.number);
        const isCardHolderInvalid = ValidationUtility.isEmpty(creditCard.holderName);

        const isExpiryMonthInvalid =
            ValidationUtility.isEmpty(creditCard.expiryMonth) ||
            !ValidationUtility.isMonthValid(creditCard.expiryMonth, creditCard.expiryYear);
        const isExpiryYearInvalid = ValidationUtility.isEmpty(creditCard.expiryYear);

        const isVerificationCodeInvalid =
            ValidationUtility.isEmpty(creditCard.verificationCode) ||
            !ValidationUtility.hasOnlyNumbers(creditCard.verificationCode) ||
            !ValidationUtility.isInRange(
                creditCard.verificationCode.length,
                MIN_LENGTH_VERIFICATION_CODE,
                MAX_LENGTH_VERIFICATION_CODE,
            );

        setFormErrors((previousState) => {
            return {
                ...previousState,
                amount: isAmountInvalid,
                currency: isCurrencyInvalid,
                number: isCreditCardNumberInvalid,
                holderName: isCardHolderInvalid,
                expiryMonth: isExpiryMonthInvalid,
                expiryYear: isExpiryYearInvalid,
                verificationCode: isVerificationCodeInvalid,
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
            shippingAddress: useShippingAddress ? { ...model.shippingAddress } : { ...model.billingAddress },
            card: { ...creditCard },
            method: 'CREDIT_CARD',
        })
            .then((data) => {
                setPaymentId(data.id);
            })
            .catch((error) => {
                pushToast(error.message, 'error');
            });
    };

    const handleModalClose = () => {
        window.location.reload();
    };

    return (
        <>
            <form className="wl-form wlv--padding-uniform" onSubmit={handleSubmit} noValidate>
                <div className="wlp-header">
                    <h1>{translations.create_card_payment}</h1>
                </div>
                <div className="wlp-container">
                    <Input
                        value={creditCard.number ?? ''}
                        onChange={(e) => handleChangeCreditCard(e, 'number')}
                        label={translations.credit_card_number}
                        maxLength={MAX_LENGTH_CARD_NUMBER}
                        className={`${formErrors.number ? 'wls--error' : ''}`}
                    />
                    <Input
                        value={creditCard.holderName ?? ''}
                        onChange={(e) => handleChangeCreditCard(e, 'holderName')}
                        label={translations.card_holder}
                        className={`${formErrors.holderName ? 'wls--error' : ''}`}
                    />
                    <div className="wlp-expiry-date">
                        <label>{translations.expiry_date}</label>
                        <div className="wlp-details">
                            <Select
                                value={creditCard.expiryMonth ?? ''}
                                options={MONTH_OPTIONS}
                                onChange={(e) => handleChangeCreditCard(e, 'expiryMonth')}
                                className={`${formErrors.expiryMonth ? 'wls--error' : ''}`}
                            />
                            <Select
                                value={creditCard.expiryYear ?? ''}
                                options={YEAR_OPTIONS}
                                onChange={(e) => handleChangeCreditCard(e, 'expiryYear')}
                                className={`${formErrors.expiryYear ? 'wls--error' : ''}`}
                            />
                        </div>
                    </div>
                    <Input
                        value={creditCard.verificationCode ?? ''}
                        onChange={(e) => handleChangeCreditCard(e, 'verificationCode')}
                        label={translations.cvv}
                        minLength={MIN_LENGTH_VERIFICATION_CODE}
                        maxLength={MAX_LENGTH_VERIFICATION_CODE}
                        className={`${formErrors.verificationCode ? 'wls--error' : ''}`}
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
                        title={translations.billing_address}
                        model={model.billingAddress}
                        onChange={(e) => handleChangeModel(e, 'billingAddress')}
                    />
                    <CheckBox
                        onChange={() => setUseShippingAddress((prev) => !prev)}
                        label={translations.billing_and_shipping_addresses_are_the_same}
                        checked={!useShippingAddress}
                    />
                    {useShippingAddress && (
                        <AddressForm
                            title={translations.shipping_address}
                            model={model.shippingAddress}
                            onChange={(e) => handleChangeModel(e, 'shippingAddress')}
                        />
                    )}
                </div>
                <div className="wlp-button">
                    <button type="submit">{translations.create_payment}</button>
                </div>
            </form>
            {isModalOpen && (
                <Modal title={translations.payment_successful} onClose={handleModalClose} payment={payment} />
            )}
        </>
    );
};

export default CardPaymentPage;
