package com.onlinepayments.example.service.interfaces.clients;

import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionRequestDto;
import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionResponseDto;
import com.onlinepayments.example.service.dtos.paymentdetails.PaymentDetailsResponseDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentRequestDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentResponseDto;

public interface PaymentClientInterface {
    CreatePaymentResponseDto createPayment(CreatePaymentRequestDto request);

    AdditionalPaymentActionResponseDto capturePayment(AdditionalPaymentActionRequestDto request);

    AdditionalPaymentActionResponseDto refundPayment(AdditionalPaymentActionRequestDto request);

    AdditionalPaymentActionResponseDto cancelPayment(AdditionalPaymentActionRequestDto request);

    PaymentDetailsResponseDto getPaymentDetailsById(String id);
}
