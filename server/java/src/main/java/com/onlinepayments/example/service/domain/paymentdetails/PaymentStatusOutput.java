package com.onlinepayments.example.service.domain.paymentdetails;

import java.util.List;

public record PaymentStatusOutput(
    List<APIError> errors,
    Boolean isAuthorized,
    Boolean isCancellable,
    Boolean isRefundable,
    String statusCategory,
    Integer statusCode,
    String statusCodeChangeDateTime
) { }
