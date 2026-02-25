package com.onlinepayments.example.service.interfaces.services;

import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkRequestDto;
import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkResponseDto;

public interface PaymentLinkServiceInterface {
    CreatePaymentLinkResponseDto createPaymentLink(CreatePaymentLinkRequestDto createPaymentLinkRequestDto);
}
