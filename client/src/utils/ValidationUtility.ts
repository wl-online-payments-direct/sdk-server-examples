const isSmallerOrEqualToZero = (value: number): boolean => {
    return value <= 0;
};

const isEmpty = (value?: string): boolean => {
    return value === '' || value === null || value === undefined;
};

const isInRange = (value: number, startRange: number, endRange: number): boolean => {
    return value >= startRange && value <= endRange;
};

const isMonthValid = (monthString: string, yearString: string): boolean => {
    const month = parseInt(monthString, 10);
    const year = parseInt(yearString, 10);

    const now = new Date();
    const currentMonth = now.getMonth() + 1;
    const currentYear = now.getFullYear();

    if (year > currentYear) {
        return true;
    }
    if (year < currentYear) {
        return false;
    }

    return month >= currentMonth;
};

const hasOnlyNumbersAndSpaces = (value: string) => {
    return /^[0-9 ]+$/.test(value);
};

const hasOnlyNumbers = (value: string) => {
    return /^[0-9]+$/.test(value);
};

export default {
    isSmallerOrEqualToZero,
    isEmpty,
    isInRange,
    isMonthValid,
    hasOnlyNumbers,
    hasOnlyNumbersAndSpaces,
};
