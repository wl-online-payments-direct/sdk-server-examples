package com.onlinepayments.example.service.handlers;

import com.onlinepayments.example.service.domain.payments.enums.PaymentMethodType;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentRequestDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentResponseDto;
import com.onlinepayments.example.service.interfaces.clients.PaymentClientInterface;
import com.onlinepayments.example.service.interfaces.clients.PaymentProductClientInterface;
import com.onlinepayments.example.service.interfaces.handlers.PaymentMethodHandlerInterface;
import org.springframework.stereotype.Component;

@Component
public class GenericPaymentHandler implements PaymentMethodHandlerInterface {
    private final PaymentClientInterface paymentClient;
    private final PaymentProductClientInterface paymentProductClient;

    public GenericPaymentHandler(PaymentClientInterface paymentClient,
                                 PaymentProductClientInterface paymentProductClient) {
        this.paymentClient = paymentClient;
        this.paymentProductClient = paymentProductClient;
    }

    @Override
    public boolean isPaymentMethodSupported(PaymentMethodType method) {
        return true;
    }

    @Override
    public CreatePaymentResponseDto createPayment(CreatePaymentRequestDto requestDto) {
        if (requestDto.getMethod() == PaymentMethodType.CREDIT_CARD &&
                requestDto.getCard() != null &&
                requestDto.getCard().number() != null) {
            requestDto.setPaymentProductId(paymentProductClient.getPaymentProductId(requestDto.getCard().number()));
        }

        return paymentClient.createPayment(requestDto);
    }
}