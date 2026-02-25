package com.onlinepayments.example.service.services;

import com.onlinepayments.example.service.domain.payments.enums.PaymentMethodType;
import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionRequestDto;
import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionResponseDto;
import com.onlinepayments.example.service.dtos.paymentdetails.PaymentDetailsResponseDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentRequestDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentResponseDto;
import com.onlinepayments.example.service.interfaces.clients.PaymentClientInterface;
import com.onlinepayments.example.service.interfaces.handlers.PaymentMethodHandlerInterface;
import com.onlinepayments.example.service.interfaces.services.PaymentServiceInterface;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class PaymentServiceImpl implements PaymentServiceInterface {
    private final List<PaymentMethodHandlerInterface> handlers;
    private final PaymentClientInterface paymentClient;

    public PaymentServiceImpl(
            List<PaymentMethodHandlerInterface> handlers,
            PaymentClientInterface paymentClient) {
        this.handlers = handlers;
        this.paymentClient = paymentClient;
    }

    @Override
    public CreatePaymentResponseDto createPayment(CreatePaymentRequestDto paymentRequest) {

        PaymentMethodType method = paymentRequest.getMethod();

        PaymentMethodHandlerInterface handler = handlers.stream()
                .filter(h -> h.isPaymentMethodSupported(method))
                .findFirst()
                .orElseThrow(() -> new UnsupportedOperationException(
                        "Unsupported payment method: " + method));

        return handler.createPayment(paymentRequest);
    }

    @Override
    public AdditionalPaymentActionResponseDto capturePayment(AdditionalPaymentActionRequestDto requestDto) {
        return paymentClient.capturePayment(requestDto);
    }

    @Override
    public AdditionalPaymentActionResponseDto refundPayment(AdditionalPaymentActionRequestDto requestDto) {
        return paymentClient.refundPayment(requestDto);
    }

    @Override
    public AdditionalPaymentActionResponseDto cancelPayment(AdditionalPaymentActionRequestDto requestDto) {
        return paymentClient.cancelPayment(requestDto);
    }

    @Override
    public PaymentDetailsResponseDto getPaymentDetailsById(String id) {
        return paymentClient.getPaymentDetailsById(id);
    }
}
