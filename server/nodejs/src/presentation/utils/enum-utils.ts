export const EnumUtils = {
    /**
     * Converts string/number to enum.
     * Handles numeric enums with reverse mapping.
     */
    toEnum<T extends Record<string, string | number>>(
        enumObject: T,
        value: string | number | null | undefined,
    ): T[keyof T] | undefined {
        if (!value) {
            return undefined;
        }

        const enumValues = Object.values(enumObject);

        return enumValues.includes(value as T[keyof T]) ? (value as T[keyof T]) : undefined;
    },

    /**
     * Converts enum to string representation.
     */
    fromEnum<T extends Record<string, string | number>>(
        enumObject: T,
        value: T[keyof T] | null | undefined,
    ): string | undefined {
        if (!value) {
            return undefined;
        }

        const enumValues = Object.values(enumObject);

        if (!enumValues.includes(value)) {
            return undefined;
        }

        return String(value);
    },

    /**
     * Checks if enum value is in allowedValues array for enum type.
     */
    isInAllowedValues<T extends Record<string, string | number>>(
        enumObject: T,
        value: string | number | null | undefined,
        allowedValues: T[keyof T][],
    ): boolean {
        if (value === null || value === undefined) {
            return false;
        }

        const enumValue = this.toEnum(enumObject, value);

        if (!enumValue) {
            return false;
        }

        return allowedValues.includes(enumValue);
    },
};
