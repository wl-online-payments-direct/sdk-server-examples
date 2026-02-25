package com.onlinepayments.example.service.interfaces.handlers;

import com.onlinepayments.example.service.domain.payments.enums.PaymentMethodType;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentRequestDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentResponseDto;

public interface PaymentMethodHandlerInterface {
    boolean isPaymentMethodSupported(PaymentMethodType method);

    CreatePaymentResponseDto createPayment(CreatePaymentRequestDto request);
}
