import { Domain } from 'onlinepayments-sdk-nodejs';
import { GetIinDetailsRequestDto } from '../../business/dtos/services/get-iin-details-request-dto';
import { GetIinDetailsResponseDto } from '../../business/dtos/services/get-iin-details-response-dto';

export class ServiceMapper {
    static toSdkIinDetailsRequest(dto: GetIinDetailsRequestDto): Domain.GetIINDetailsRequest {
        return {
            bin: dto.bin,
        };
    }

    static fromSdkIinDetailsResponse(response: Domain.GetIINDetailsResponse): GetIinDetailsResponseDto {
        return {
            paymentProductId: response.paymentProductId,
        };
    }
}
