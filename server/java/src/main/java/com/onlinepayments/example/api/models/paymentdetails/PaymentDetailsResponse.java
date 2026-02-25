package com.onlinepayments.example.api.models.paymentdetails;

import com.onlinepayments.example.service.domain.paymentdetails.HostedCheckoutSpecificOutput;
import com.onlinepayments.example.service.domain.paymentdetails.OperationOutput;
import com.onlinepayments.example.service.domain.paymentdetails.PaymentOutput;
import com.onlinepayments.example.service.domain.paymentdetails.PaymentStatusOutput;

import java.util.List;

public record PaymentDetailsResponse(
        List<OperationOutput> operations,
        HostedCheckoutSpecificOutput hostedCheckoutSpecificOutput,
        PaymentOutput paymentOutput,
        String status,
        PaymentStatusOutput statusOutput,
        String id
) { }
