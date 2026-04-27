import { StatusCategory } from '../common/enums/status-category';

export type StatusOutput = {
    statusCode?: number | null;
    statusCategory?: StatusCategory | null;
};
