package com.onlinepayments.example.service.interfaces.services;

import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionRequestDto;
import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionResponseDto;
import com.onlinepayments.example.service.dtos.paymentdetails.PaymentDetailsResponseDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentRequestDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentResponseDto;

public interface PaymentServiceInterface {
    CreatePaymentResponseDto createPayment(CreatePaymentRequestDto paymentRequest);

    AdditionalPaymentActionResponseDto capturePayment(AdditionalPaymentActionRequestDto requestDto);

    AdditionalPaymentActionResponseDto refundPayment(AdditionalPaymentActionRequestDto requestDto);

    AdditionalPaymentActionResponseDto cancelPayment(AdditionalPaymentActionRequestDto requestDto);

    PaymentDetailsResponseDto getPaymentDetailsById(String id);
}
