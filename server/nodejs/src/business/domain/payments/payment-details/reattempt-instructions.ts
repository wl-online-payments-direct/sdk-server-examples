import { ReattemptInstructionsConditions } from './reattempt-instructions-conditions';

export type ReattemptInstructions = {
    conditions?: ReattemptInstructionsConditions | null;
    frozenPeriod?: number | null;
    indicator?: string | null;
};
