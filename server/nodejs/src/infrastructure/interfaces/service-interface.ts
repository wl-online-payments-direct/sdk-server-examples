import { FastifyBaseLogger } from 'fastify';
import { GetIinDetailsRequestDto } from '../../business/dtos/services/get-iin-details-request-dto';
import { GetIinDetailsResponseDto } from '../../business/dtos/services/get-iin-details-response-dto';

export interface IServiceClient {
    getIinDetails(
        request: GetIinDetailsRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<GetIinDetailsResponseDto | null>;
}