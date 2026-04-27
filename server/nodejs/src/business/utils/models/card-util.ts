export const CardUtil = {
    getYearSuffix(year?: string | null): string {
        if (!year) {
            return '';
        }

        return year.substring(year.length - 2);
    },
};
