import type { ChangeEvent } from 'react';
import './checkbox.scss';

type Props = {
    checked?: boolean;
    onChange: (value: boolean) => void;
    className?: string;
    label?: string;
};

const CheckBox = ({ checked, onChange, label, className = '' }: Props) => {
    const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
        onChange(e.target?.checked);
    };

    return (
        <label className={`wl-checkbox ${className ?? ''}`}>
            <input type="checkbox" checked={checked} onChange={handleChange} className="wlp-checkbox" />
            <span>{label}</span>
        </label>
    );
};

export default CheckBox;
