import { Status } from '../../../domain/enums/payments/status';
import { StatusOutput } from '../../../domain/payments/status-output';

export type CreatePaymentResponseDto = {
    id?: string | null;
    status?: Status | null;
    statusOutput?: StatusOutput | null;
};
