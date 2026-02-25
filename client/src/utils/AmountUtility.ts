const unmaskAmount = (value: string): string => {
    return value.replace(/_/g, '0').replace(/\.$/, '').trim();
};

const parseAmount = (value: string): number => {
    const unmaskedAmount = unmaskAmount(value);
    const numberValue = Number(unmaskedAmount);

    if (isNaN(numberValue)) {
        return 0;
    }

    return parseFloat(numberValue.toFixed(2));
};

export default { parseAmount };
