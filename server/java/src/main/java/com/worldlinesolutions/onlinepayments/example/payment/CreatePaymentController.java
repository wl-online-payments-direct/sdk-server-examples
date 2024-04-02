package com.worldlinesolutions.onlinepayments.example.payment;

import com.onlinepayments.domain.CreatePaymentResponse;
import com.onlinepayments.domain.PaymentDetailsResponse;
import io.micrometer.common.util.StringUtils;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/createpayment")
public class CreatePaymentController {

    private final CreatePaymentMapper createPaymentMapper;
    private final CreatePaymentService createPaymentService;
    private final PaymentDetailsService paymentDetailsService;

    public CreatePaymentController(CreatePaymentMapper createPaymentMapper, CreatePaymentService createPaymentService, PaymentDetailsService paymentDetailsService) {
        this.createPaymentMapper = createPaymentMapper;
        this.createPaymentService = createPaymentService;
        this.paymentDetailsService = paymentDetailsService;
    }

    @GetMapping
    public CreatePaymentBasicDto initializeRequest() {
        return createPaymentMapper.toEmptyBasicDto();
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
    public CreatePaymentResponse createPaymentResponse(@RequestBody CreatePaymentBasicDto createPaymentBasicDto) {
        return createPaymentService.createPayment(
                createPaymentMapper.toCreatePaymentRequest(createPaymentBasicDto)
        );
    }

}
