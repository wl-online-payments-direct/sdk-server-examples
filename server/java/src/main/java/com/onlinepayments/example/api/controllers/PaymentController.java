package com.onlinepayments.example.api.controllers;

import com.onlinepayments.example.api.mappers.AdditionalPaymentActionApiMapper;
import com.onlinepayments.example.api.mappers.PaymentApiMapper;
import com.onlinepayments.example.api.mappers.PaymentDetailsApiMapper;
import com.onlinepayments.example.api.models.additionalpaymentactions.AdditionalPaymentActionRequest;
import com.onlinepayments.example.api.models.additionalpaymentactions.AdditionalPaymentActionResponse;
import com.onlinepayments.example.api.models.paymentdetails.PaymentDetailsResponse;
import com.onlinepayments.example.api.models.payments.CreatePaymentRequest;
import com.onlinepayments.example.api.models.payments.CreatePaymentResponse;
import com.onlinepayments.example.api.validators.additionalpaymentactionvalidator.AdditionalPaymentActionValidator;
import com.onlinepayments.example.api.validators.payment.PaymentValidator;
import com.onlinepayments.example.service.interfaces.services.PaymentServiceInterface;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.net.URI;

@RestController
@RequestMapping("/payments")
public class PaymentController {
    private final PaymentServiceInterface paymentService;
    private final PaymentApiMapper paymentApiMapper;
    private final AdditionalPaymentActionApiMapper additionalPaymentActionApiMapper;
    private final PaymentValidator paymentValidator;
    private final AdditionalPaymentActionValidator additionalPaymentActionValidator;
    private final PaymentDetailsApiMapper paymentDetailsApiMapper;


    public PaymentController(
            PaymentServiceInterface paymentService,
            PaymentApiMapper paymentApiMapper,
            PaymentValidator paymentValidator,
            AdditionalPaymentActionApiMapper additionalPaymentActionApiMapper,
            AdditionalPaymentActionValidator additionalPaymentActionValidator, PaymentDetailsApiMapper paymentDetailsApiMapper) {
        this.paymentService = paymentService;
        this.paymentApiMapper = paymentApiMapper;
        this.additionalPaymentActionApiMapper = additionalPaymentActionApiMapper;
        this.paymentValidator = paymentValidator;
        this.additionalPaymentActionValidator = additionalPaymentActionValidator;
        this.paymentDetailsApiMapper = paymentDetailsApiMapper;
    }

    @PostMapping
    public ResponseEntity<CreatePaymentResponse> createPayment(
            @RequestBody CreatePaymentRequest request) {
        paymentValidator.validate(request);

        CreatePaymentResponse response =
                paymentApiMapper.toApiResponse(paymentService.createPayment(paymentApiMapper.toRequestDto(request)));

        return ResponseEntity.created(URI.create("")).body(response);
    }

    @PostMapping("/{id}/captures")
    public ResponseEntity<AdditionalPaymentActionResponse> capturePayment(
            @RequestBody AdditionalPaymentActionRequest request,
            @PathVariable("id") String id
    ) {
        additionalPaymentActionValidator.validate(request);

        AdditionalPaymentActionResponse response =
                additionalPaymentActionApiMapper.toApiResponse(
                        paymentService.capturePayment(additionalPaymentActionApiMapper.toDto(request, id)));

        return ResponseEntity.ok(response);
    }

    @PostMapping("/{id}/refunds")
    public ResponseEntity<AdditionalPaymentActionResponse> refundPayment(
            @RequestBody AdditionalPaymentActionRequest request,
            @PathVariable("id") String id
    ) {
        additionalPaymentActionValidator.validate(request);

        AdditionalPaymentActionResponse response =
                additionalPaymentActionApiMapper.toApiResponse(
                        paymentService.refundPayment(additionalPaymentActionApiMapper.toDto(request, id)));

        return ResponseEntity.ok(response);
    }

    @PostMapping("/{id}/cancels")
    public ResponseEntity<AdditionalPaymentActionResponse> cancelPayment(
            @RequestBody AdditionalPaymentActionRequest request,
            @PathVariable("id") String id
    ) {
        additionalPaymentActionValidator.validate(request);

        AdditionalPaymentActionResponse response =
                additionalPaymentActionApiMapper.toApiResponse(
                        paymentService.cancelPayment(additionalPaymentActionApiMapper.toDto(request, id)));

        return ResponseEntity.ok(response);
    }

    @GetMapping("/{id}")
    public ResponseEntity<PaymentDetailsResponse> getPaymentDetails(
            @PathVariable("id") String id) {
        PaymentDetailsResponse response = paymentDetailsApiMapper.toApiResponse(paymentService.getPaymentDetailsById(id));

        return ResponseEntity.ok().body(response);
    }
}
