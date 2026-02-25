package com.onlinepayments.example.service.interfaces.clients;

import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkRequestDto;
import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkResponseDto;

public interface PaymentLinkClientInterface {
    CreatePaymentLinkResponseDto createPaymentLink(CreatePaymentLinkRequestDto request);
}