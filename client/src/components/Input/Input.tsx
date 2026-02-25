import { type ChangeEvent, memo, useEffect, useRef } from 'react';
import './input.scss';
import InputMask from 'inputmask';

type Props = {
    hasNumericMask?: boolean;
    value?: string;
    onChange?: (value: string) => void;
    type?: 'text';
    className?: string;
    label?: string;
    placeholder?: string;
    readOnly?: boolean;
    minLength?: number;
    maxLength?: number;
};

const Input = ({
    hasNumericMask,
    onChange,
    value,
    label,
    minLength,
    maxLength,
    type = 'text',
    readOnly = false,
    placeholder = '',
    className = '',
}: Props) => {
    const inputRef = useRef<HTMLInputElement>(null);

    const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
        onChange?.(e.target?.value);
    };

    useEffect(() => {
        if (hasNumericMask && inputRef.current) {
            InputMask({
                mask: '9{+}.9{2}',
                placeholder: '_',
                showMaskOnHover: true,
                showMaskOnFocus: true,
            }).mask(inputRef.current);
        } else if (inputRef.current) {
            InputMask.remove(inputRef.current);
        }
    }, [hasNumericMask]);

    return (
        <label className={`wl-input ${className ?? ''}`}>
            {label && <span>{label}</span>}
            <input
                ref={inputRef}
                type={type}
                value={value}
                readOnly={readOnly}
                onChange={handleChange}
                minLength={minLength}
                maxLength={maxLength}
                placeholder={placeholder}
                className="wlp-input"
            />
        </label>
    );
};

export default memo(Input);
