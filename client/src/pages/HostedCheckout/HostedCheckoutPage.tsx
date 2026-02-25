import { type FormEvent, useState } from 'react';
import '../../styles/form.scss';
import { useToast } from '../../components/Toast/ToastContext/useToast.ts';
import ApiService from '../../services/ApiService.ts';
import AmountUtility from '../../utils/AmountUtility.ts';
import ValidationUtility from '../../utils/ValidationUtility.ts';
import Input from '../../components/Input/Input.tsx';
import Select from '../../components/Select/Select.tsx';
import CheckBox from '../../components/CheckBox/CheckBox.tsx';
import AddressForm from '../../components/AddressForm/AddressForm.tsx';
import { COUNTRY_OPTIONS, CURRENCY_OPTIONS, LANGUAGE_OPTIONS } from '../../utils/constants.ts';
import translations from '../../translations/translations.ts';
import type { Address } from '../../models/Address.ts';

type FormDetails = {
    amount: string;
    currency: string;
    language?: string;
    redirectUrl?: string;
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

const HostedCheckoutPage = () => {
    const { pushToast } = useToast();

    const [model, setModel] = useState<Partial<FormModel>>({
        ...FormDetailsInitialState,
        shippingAddress: { ...AddressesInitialState },
        billingAddress: { ...AddressesInitialState },
    });

    const [useShippingAddress, setUseShippingAddress] = useState(true);

    const [formErrors, setFormErrors] = useState<FormError>({ amount: false, currency: false });

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

        setFormErrors((previousState) => {
            return {
                ...previousState,
                amount: isAmountInvalid,
                currency: isCurrencyInvalid,
            };
        });

        return true;
    };

    const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault();

        if (!isFormValid()) {
            return;
        }

        const finalRedirectUrl =
            model.redirectUrl && model.redirectUrl.trim() !== ''
                ? model.redirectUrl
                : translations.default_redirect_url;
        ApiService.createHostedCheckout({
            ...(model as FormModel),
            redirectUrl: finalRedirectUrl,
            amount: AmountUtility.parseAmount(model.amount ?? ''),
            shippingAddress: useShippingAddress ? { ...model.shippingAddress } : { ...model.billingAddress },
        })
            .then((data) => {
                localStorage.setItem('hostedCheckoutId', data.hostedCheckoutId);
                window.location.href = data.redirectUrl;
            })
            .catch((error) => {
                pushToast(error.message, 'error');
            });
    };

    return (
        <form className="wl-form wlv--padding-uniform" onSubmit={handleSubmit}>
            <div className="wlp-header">
                <h1>{translations.create_hosted_checkout_session}</h1>
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
                    <Select
                        value={model.language}
                        options={LANGUAGE_OPTIONS}
                        label={translations.language}
                        onChange={(e) => handleChange(e, 'language')}
                    />
                    <Input
                        value={model.redirectUrl}
                        onChange={(e) => handleChange(e, 'redirectUrl')}
                        label={translations.redirect_url}
                        placeholder={translations.default_redirect_url}
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
            </div>
            <div className="wlp-button">
                <button type="submit">{translations.create_hosted_checkout_session}</button>
            </div>
        </form>
    );
};

export default HostedCheckoutPage;
