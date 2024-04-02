package com.worldlinesolutions.onlinepayments.example.hostedtokenization;

import com.onlinepayments.domain.CreateHostedTokenizationResponse;
import com.onlinepayments.domain.CreatePaymentResponse;
import com.onlinepayments.domain.PaymentDetailsResponse;
import com.worldlinesolutions.onlinepayments.example.payment.CreatePaymentService;
import com.worldlinesolutions.onlinepayments.example.payment.PaymentDetailsService;
import io.micrometer.common.util.StringUtils;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/hostedtokenization")
public class HostedTokenizationController {

    private final HostedTokenizationMapper hostedTokenizationMapper;
    private final HostedTokenizationService hostedTokenizationService;
    private final CreatePaymentService createPaymentService;
    private final PaymentDetailsService paymentDetailsService;

    public HostedTokenizationController(
            HostedTokenizationMapper hostedTokenizationMapper,
            HostedTokenizationService hostedTokenizationService,
            CreatePaymentService createPaymentService,
            PaymentDetailsService paymentDetailsService
    ) {
        this.hostedTokenizationMapper = hostedTokenizationMapper;
        this.hostedTokenizationService = hostedTokenizationService;
        this.createPaymentService = createPaymentService;
        this.paymentDetailsService = paymentDetailsService;
    }

    @GetMapping
    public CreateHostedTokenizationResponse getHostedTokenization() {
        return hostedTokenizationService.initHostedTokenization();
    }

    @GetMapping("/outcome")
    public PaymentDetailsResponse getPaymentResponse(
            @RequestParam("paymentId") String paymentId
    ) {
        if (StringUtils.isEmpty(paymentId))
            throw new IllegalArgumentException("Payment id is missing!");

        return paymentDetailsService.getPaymentDetails(paymentId);
    }

    @PostMapping("/basic")
    public CreatePaymentResponse createHostedTokenization(@RequestBody CreateHostedTokenizationBasicDto createHostedTokenizationBasicDto) {
        return createPaymentService.createHostedTokenizationPayment(
                hostedTokenizationMapper.toHostedTokenizationPaymentRequest(createHostedTokenizationBasicDto)
        );
    }

}

