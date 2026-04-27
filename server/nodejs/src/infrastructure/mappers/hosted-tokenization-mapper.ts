import { Domain } from 'onlinepayments-sdk-nodejs';
import { GetHostedTokenizationResponseDto } from '../../business/dtos/hosted-tokenization/get-hosted-tokenization-response-dto';

export const HostedTokenizationMapper = {
    fromSdkResponse(response?: Domain.CreateHostedTokenizationResponse): GetHostedTokenizationResponseDto {
        return {
            hostedTokenizationId: response?.hostedTokenizationId,
            hostedTokenizationUrl: response?.hostedTokenizationUrl,
        };
    },
};
