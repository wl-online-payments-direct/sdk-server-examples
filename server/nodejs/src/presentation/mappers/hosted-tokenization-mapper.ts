import { GetHostedTokenizationResponse } from '../models/hosted-tokenization/get-hosted-tokenization-response';
import { GetHostedTokenizationResponseDto } from '../../business/dtos/hosted-tokenization/get-hosted-tokenization-response-dto';

export const HostedTokenizationMapper = {
    fromDto: (dto: GetHostedTokenizationResponseDto): GetHostedTokenizationResponse => {
        return {
            hostedTokenizationId: dto.hostedTokenizationId,
            hostedTokenizationUrl: dto.hostedTokenizationUrl,
        };
    },
};
