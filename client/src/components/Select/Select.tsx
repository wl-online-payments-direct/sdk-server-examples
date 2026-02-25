import type { ChangeEvent } from 'react';
import './select.scss';

type Option = {
    label: string;
    value: string;
    disabled?: boolean;
};

type Props = {
    label?: string;
    value?: string;
    options?: Option[];
    onChange: (value: string) => void;
    className?: string;
};

const Select = ({ label, value, options, onChange, className = '' }: Props) => {
    const handleChange = (e: ChangeEvent<HTMLSelectElement>) => {
        onChange(e.target?.value);
    };

    return (
        <label className={`wl-select ${className ?? ''}`}>
            {label && <span>{label}</span>}
            <select className="wlp-select" onChange={handleChange} defaultValue={value}>
                {options?.map((option) => (
                    <option key={option.value} value={option.value}>
                        {option.label}
                    </option>
                ))}
            </select>
        </label>
    );
};

export default Select;
