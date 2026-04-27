import { Country } from '../../domain/common/enums/country';

export type AddressDto = {
    firstName?: string | null;
    lastName?: string | null;
    country?: Country | null;
    zip?: string | null;
    city?: string | null;
    street?: string | null;
};

export function fromJson(data: any): AddressDto {
    return {
        firstName: data?.firstName,
        lastName: data?.lastName,
        country: data?.country ? (data.country as Country) : undefined,
        zip: data?.zip,
        city: data?.city,
        street: data?.street,
    };
}

export function toJson(dto: AddressDto): Record<string, any> {
    return {
        firstName: dto.firstName,
        lastName: dto.lastName,
        country: dto.country,
        zip: dto.zip,
        city: dto.city,
        street: dto.street,
    };
}
