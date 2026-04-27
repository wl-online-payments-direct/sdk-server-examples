import { PersonalName } from './personal-name';

export type AddressPersonal = {
    additionalInfo?: string | null;
    city?: string | null;
    companyName?: string | null;
    countryCode?: string | null;
    houseNumber?: string | null;
    name?: PersonalName | null;
    state?: string | null;
    street?: string | null;
    zip?: string | null;
};
