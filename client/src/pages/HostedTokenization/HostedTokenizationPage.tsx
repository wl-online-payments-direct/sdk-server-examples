import { useEffect, useRef, useState } from 'react';
import '../../styles/form.scss';
import '../../styles/section.scss';
import { useToast } from '../../components/Toast/ToastContext/useToast.ts';
import type { Address } from '../../models/Address.ts';
import Input from '../../components/Input/Input.tsx';
import Select from '../../components/Select/Select.tsx';
import CheckBox from '../../components/CheckBox/CheckBox.tsx';
import AddressForm from '../../components/AddressForm/AddressForm.tsx';
import ApiService from '../../services/ApiService.ts';
import AmountUtility from '../../utils/AmountUtility.ts';
import ValidationUtility from '../../utils/ValidationUtility.ts';
import type { TokenizerError, TokenizerInstance } from '../../models/Tokenizer.ts';
import { COUNTRY_OPTIONS, CURRENCY_OPTIONS } from '../../utils/constants.ts';
import translations from '../../translations/translations.ts';
import Modal from '../../components/Modal/Modal.tsx';
import type { PaymentOutcomeResponse } from '../../models/Payment.ts';

type FormDetails = {
    amount: string;
    currency: string;
};

type FormError = {
    amount: boolean;
    currency: boolean;
};

type FormModel = FormDetails & {
    shippingAddress?: Address;
    billingAddress?: Address;
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

const FormErrorsInitialState = { amount: false, currency: false };

const HostedTokenizationPage = () => {
    const { pushToast } = useToast();

    const didFetchRef = useRef(false);

    const [tokenData, setTokenData] = useState<{
        hostedTokenizationId?: string;
        hostedTokenizationUrl?: string;
        submitted: boolean;
    }>();

    const tokenizerRef = useRef<TokenizerInstance>(null);

    const [model, setModel] = useState<Partial<FormModel>>({
        ...FormDetailsInitialState,
        shippingAddress: { ...AddressesInitialState },
        billingAddress: { ...AddressesInitialState },
    });

    const [useShippingAddress, setUseShippingAddress] = useState(true);

    const [formErrors, setFormErrors] = useState<FormError>({ ...FormErrorsInitialState });

    const [paymentId, setPaymentId] = useState('');
    const [payment, setPayment] = useState<PaymentOutcomeResponse>();
    const [isModalOpen, setIsModalOpen] = useState(false);

    const handleInitializeTokenizer = (url: string) => {
        if (typeof window.Tokenizer !== 'function') {
            return;
        }

        if (tokenizerRef.current) {
            return;
        }

        tokenizerRef.current = new window.Tokenizer(url, 'hosted-tokenization', {
            hideCardholderName: false,
        });

        tokenizerRef.current.initialize().catch((reason: TokenizerError) => {
            pushToast(reason?.message as string, 'error');
            tokenizerRef.current = null;
        });
    };

    const handleChange = (value: string | Address, prop: keyof FormModel) => {
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

        setFormErrors((previousState) => ({
            ...previousState,
            amount: isAmountInvalid,
            currency: isCurrencyInvalid,
        }));

        return true;
    };

    const handleSubmit = () => {
        if (!isFormValid()) {
            return;
        }

        if (tokenData?.hostedTokenizationId && tokenData.submitted) {
            createPayment(tokenData.hostedTokenizationId);
            return;
        }

        tokenizerRef?.current
            ?.submitTokenization()
            .then((response) => {
                if (response.success) {
                    setTokenData((prev) => ({ ...prev, submitted: response.success }));
                    createPayment(response.hostedTokenizationId);
                } else {
                    pushToast(response.error?.message as string, 'error');
                }
            })
            .catch((error) => {
                pushToast(error?.message as string, 'error');
            });
    };

    const createPayment = (hostedTokenizationId?: string) => {
        ApiService.createPayment({
            ...(model as FormModel),
            shippingAddress: useShippingAddress ? { ...model.shippingAddress } : { ...model.billingAddress },
            hostedTokenizationId: hostedTokenizationId,
            amount: AmountUtility.parseAmount(model.amount ?? ''),
            method: 'TOKEN',
        })
            .then((response) => {
                setPaymentId(response.id);
            })
            .catch((error) => {
                pushToast(error.message, 'error');
            });
    };

    const handleModalClose = () => {
        window.location.reload();
    };

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

    useEffect(() => {
        if (!tokenData?.hostedTokenizationUrl) {
            return;
        }

        handleInitializeTokenizer(tokenData.hostedTokenizationUrl);
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [tokenData?.hostedTokenizationUrl]);

    useEffect(() => {
        if (didFetchRef.current) {
            return;
        }

        didFetchRef.current = true;

        ApiService.fetchHostedTokenization()
            .then((data) => {
                setTokenData({ ...data, submitted: false });
            })
            .catch((error) => {
                pushToast(error.message, 'error');
            });

        return () => {};
    }, []);

    return (
        <>
            <form className="wl-form wlv--padding-bottom-larger" onSubmit={(e) => e.preventDefault()}>
                <div className="wlp-header">
                    <h1>{translations.create_payment_using_hosted_tokenization}</h1>
                </div>
                <div className="wlp-container">
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
                    <AddressForm
                        title={translations.billing_address}
                        model={model.billingAddress}
                        onChange={(e) => handleChange(e, 'billingAddress')}
                    />
                    <CheckBox
                        onChange={() => setUseShippingAddress((prev) => !prev)}
                        checked={!useShippingAddress}
                        label={translations.billing_and_shipping_addresses_are_the_same}
                    />
                    {useShippingAddress && (
                        <AddressForm
                            title={translations.shipping_address}
                            model={model.shippingAddress}
                            onChange={(e) => handleChange(e, 'shippingAddress')}
                        />
                    )}
                    <label>{translations.card_details_label}</label>
                    <div className="wlp-iframe" id="hosted-tokenization"></div>
                </div>
                <div className="wlp-button">
                    <button type="button" onClick={handleSubmit}>
                        {translations.create_payment}
                    </button>
                </div>
            </form>
            {isModalOpen && (
                <Modal onClose={handleModalClose} title={translations.payment_successful} payment={payment} />
            )}
        </>
    );
};

export default HostedTokenizationPage;
