package com.onlinepayments.example.service.domain.paymentdetails;

public record ThreeDSecureResults(
        String acsTransactionId,
        String appliedExemption,
        String authenticationStatus,
        String cavv,
        String challengeIndicator,
        String dsTransactionId,
        String eci,
        String exemptionEngineFlow,
        String flow,
        String liability,
        String schemeEci,
        String version,
        String xid
) { }
