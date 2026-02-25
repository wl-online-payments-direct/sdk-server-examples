<?php

namespace OnlinePayments\ExampleApp\Application\Domain\Payments\PaymentDetails;

final class ThreeDSecureResults
{
    public ?string $acsTransactionId = null;
    public ?string $appliedExemption = null;
    public ?string $authenticationStatus = null;
    public ?string $cavv = null;
    public ?string $challengeIndicator = null;
    public ?string $dsTransactionId = null;
    public ?string $eci = null;
    public ?string $exemptionEngineFlow = null;
    public ?string $flow = null;
    public ?string $liability = null;
    public ?string $schemeEci = null;
    public ?string $version = null;
    public ?string $xid = null;

    public function toArray(): array
    {
        return [
            'acsTransactionId' => $this->acsTransactionId,
            'appliedExemption' => $this->appliedExemption,
            'authenticationStatus' => $this->authenticationStatus,
            'cavv' => $this->cavv,
            'challengeIndicator' => $this->challengeIndicator,
            'dsTransactionId' => $this->dsTransactionId,
            'eci' => $this->eci,
            'exemptionEngineFlow' => $this->exemptionEngineFlow,
            'flow' => $this->flow,
            'liability' => $this->liability,
            'schemeEci' => $this->schemeEci,
            'version' => $this->version,
            'xid' => $this->xid,
        ];
    }
}
