package com.onlinepayments.example.api.controllers;

import com.onlinepayments.example.api.mappers.PaymentLinkApiMapper;
import com.onlinepayments.example.api.models.paymentlinks.CreatePaymentLinkRequest;
import com.onlinepayments.example.api.models.paymentlinks.CreatePaymentLinkResponse;
import com.onlinepayments.example.api.validators.paymentlink.PaymentLinkValidator;
import com.onlinepayments.example.service.interfaces.services.PaymentLinkServiceInterface;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.net.URI;

@RestController
@RequestMapping("/links")
public class PaymentLinkController {
    private final PaymentLinkServiceInterface paymentLinkService;
    private final PaymentLinkApiMapper paymentLinkApiMapper;
    private final PaymentLinkValidator paymentLinkValidator;

    @Autowired
    public PaymentLinkController(
            PaymentLinkServiceInterface paymentLinkService,
            PaymentLinkApiMapper paymentLinkApiMapper,
            PaymentLinkValidator paymentLinkValidator) {
        this.paymentLinkService = paymentLinkService;
        this.paymentLinkApiMapper = paymentLinkApiMapper;
        this.paymentLinkValidator = paymentLinkValidator;
    }

    @PostMapping
    public ResponseEntity<CreatePaymentLinkResponse> createPaymentLink(
            @RequestBody CreatePaymentLinkRequest request) {
        paymentLinkValidator.validate(request);

        CreatePaymentLinkResponse response =
                paymentLinkApiMapper.toApiResponse(paymentLinkService.createPaymentLink(paymentLinkApiMapper.toRequestDto(request)));

        return ResponseEntity.created(URI.create("")).body(response);
    }
}
