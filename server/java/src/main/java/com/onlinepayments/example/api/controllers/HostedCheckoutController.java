package com.onlinepayments.example.api.controllers;

import com.onlinepayments.example.api.mappers.HostedCheckoutApiMapper;
import com.onlinepayments.example.api.models.hostedcheckout.CreateHostedCheckoutRequest;
import com.onlinepayments.example.api.models.hostedcheckout.CreateHostedCheckoutResponse;
import com.onlinepayments.example.api.models.paymentbyhostedcheckoutid.GetPaymentByHostedCheckoutIdResponse;
import com.onlinepayments.example.api.validators.hostedcheckout.HostedCheckoutValidator;
import com.onlinepayments.example.service.interfaces.services.HostedCheckoutServiceInterface;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.net.URI;

@RestController
@RequestMapping("/sessions")
public class HostedCheckoutController {
    private final HostedCheckoutServiceInterface hostedCheckoutService;
    private final HostedCheckoutApiMapper hostedCheckoutApiMapper;
    private final HostedCheckoutValidator hostedCheckoutValidator;

    @Autowired
    public HostedCheckoutController(
            HostedCheckoutServiceInterface hostedCheckoutService,
            HostedCheckoutApiMapper hostedCheckoutApiMapper,
            HostedCheckoutValidator hostedCheckoutValidator) {
        this.hostedCheckoutService = hostedCheckoutService;
        this.hostedCheckoutApiMapper = hostedCheckoutApiMapper;
        this.hostedCheckoutValidator = hostedCheckoutValidator;
    }

    @PostMapping
    public ResponseEntity<CreateHostedCheckoutResponse> createHostedCheckoutSessions(
            @RequestBody CreateHostedCheckoutRequest request) {
        hostedCheckoutValidator.validate(request);

        CreateHostedCheckoutResponse response =
                hostedCheckoutApiMapper.toApiCreateResponse(hostedCheckoutService.createHostedCheckout(hostedCheckoutApiMapper.toCreateRequestDto(request)));

        return ResponseEntity.created(URI.create("")).body(response);
    }

    @GetMapping("/{id}")
    public ResponseEntity<GetPaymentByHostedCheckoutIdResponse> getPaymentByHostedCheckoutId(
            @PathVariable("id") String id) {
        GetPaymentByHostedCheckoutIdResponse response =
                hostedCheckoutApiMapper.toApiGetPaymentResponse(hostedCheckoutService.getPaymentByHostedCheckoutId(id));

        return ResponseEntity.ok().body(response);
    }
}
