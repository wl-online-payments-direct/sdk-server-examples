export class UrlRules {
    static validate(url: string | null | undefined): boolean {
        try {
            if (url == null) {
                return false;
            }

            const trimmed = url.trim();

            if (!/^https?:\/\//i.test(trimmed)) {
                return false;
            }

            new URL(trimmed);

            return true;
        } catch {
            return false;
        }
    }
}
