package com.worldlinesolutions.onlinepayments.example.hostedcheckout;

import com.onlinepayments.domain.CreateHostedCheckoutResponse;
import com.onlinepayments.domain.PaymentDetailsResponse;
import com.worldlinesolutions.onlinepayments.example.payment.PaymentDetailsService;
import io.micrometer.common.util.StringUtils;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/hostedcheckout")
public class HostedCheckoutController {

    private final HostedCheckoutMapper hostedCheckoutMapper;
    private final HostedCheckoutService hostedCheckoutService;
    private final PaymentDetailsService paymentDetailsService;

    public HostedCheckoutController(
            HostedCheckoutMapper hostedCheckoutMapper,
            HostedCheckoutService hostedCheckoutService,
            PaymentDetailsService paymentDetailsService
    ) {
        this.hostedCheckoutMapper = hostedCheckoutMapper;
        this.hostedCheckoutService = hostedCheckoutService;
        this.paymentDetailsService = paymentDetailsService;
    }

    @GetMapping
    public CreateHostedCheckoutBasicDto getHostedCheckout() {
        return hostedCheckoutMapper.toEmptyDto();
    }

    @GetMapping("/outcome")
    public PaymentDetailsResponse getPaymentResponse(
            @RequestParam("RETURNMAC") String returnMac,
            @RequestParam("hostedCheckoutId") String hostedCheckoutId
    ) {
        if (StringUtils.isEmpty(hostedCheckoutId))
            throw new IllegalArgumentException("Hosted checkout id is missing!");

        return paymentDetailsService.getPaymentDetailsForHostedCheckout(hostedCheckoutId);
    }

    @PostMapping("/basic")
    public CreateHostedCheckoutResponse createHostedCheckout(@RequestBody CreateHostedCheckoutBasicDto createHostedCheckoutBasicDto) {
        return hostedCheckoutService.createHostedCheckoutResponse(
                hostedCheckoutMapper.toCreateHostedCheckoutRequest(createHostedCheckoutBasicDto)
        );
    }

}

