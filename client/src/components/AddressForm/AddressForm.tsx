import { memo } from 'react';
import './address-form.scss';
import Input from '../Input/Input.tsx';
import Select from '../Select/Select.tsx';
import { COUNTRY_OPTIONS } from '../../utils/constants.ts';
import translations from '../../translations/translations.ts';
import type { Address } from '../../models/Address.ts';

type Props = {
    title?: string;
    model?: Address;
    onChange: (value: Address) => void;
};

const AddressForm = ({ title, onChange, model }: Props) => {
    const { firstName, lastName, country, zip, city, street } = model || {};

    const handleChange = (value: string, prop: keyof Address) => {
        onChange({
            ...model,
            [prop]: value,
        });
    };

    return (
        <div className="wl-address-form">
            <label className="wlp-label">{title}</label>
            <div className="wlp-grid">
                <div className="wlp-grid-item">
                    <Input
                        value={firstName}
                        onChange={(value) => handleChange(value, 'firstName')}
                        label={translations.first_name}
                    />
                </div>
                <div className="wlp-grid-item">
                    <Input
                        value={lastName}
                        onChange={(value) => handleChange(value, 'lastName')}
                        label={translations.last_name}
                    />
                </div>
                <div className="wlp-grid-item">
                    <Select
                        value={country}
                        label={translations.country}
                        options={COUNTRY_OPTIONS}
                        onChange={(value) => handleChange(value, 'country')}
                    />
                </div>
                <div className="wlp-grid-item">
                    <Input value={zip} onChange={(value) => handleChange(value, 'zip')} label={translations.zip} />
                </div>
                <div className="wlp-grid-item">
                    <Input value={city} onChange={(value) => handleChange(value, 'city')} label={translations.city} />
                </div>
                <div className="wlp-grid-item">
                    <Input
                        value={street}
                        onChange={(value) => handleChange(value, 'street')}
                        label={translations.street}
                    />
                </div>
            </div>
        </div>
    );
};

export default memo(AddressForm);
