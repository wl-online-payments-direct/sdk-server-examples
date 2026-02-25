import type { ChangeEvent } from 'react';
import './radio-group.scss';

type Option = { label: string; value: string };

type Props = {
    selectedValue: string;
    options: Option[];
    onChange?: (value: string) => void;
    name: string;
    title: string;
};

const RadioGroup = ({ title, options, name, selectedValue, onChange }: Props) => {
    const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
        onChange?.(e.target?.value);
    };

    return (
        <p className="wl-radio-group">
            <label>{title}</label>
            {options.map((option) => (
                <label key={option.value} className="wlp-option">
                    <input
                        type="radio"
                        name={name}
                        value={option.value}
                        checked={selectedValue === option.value}
                        onChange={handleChange}
                    />
                    {option.label}
                </label>
            ))}
        </p>
    );
};

export default RadioGroup;
