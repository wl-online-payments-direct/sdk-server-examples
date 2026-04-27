import { Status } from '../../../../business/domain/enums/payments/status';
import { StatusOutput } from '../../../../business/domain/payments/status-output';

export interface AdditionalPaymentActionResponse {
    id?: string | null;
    status?: Status | null;
    statusOutput?: StatusOutput | null;
}
