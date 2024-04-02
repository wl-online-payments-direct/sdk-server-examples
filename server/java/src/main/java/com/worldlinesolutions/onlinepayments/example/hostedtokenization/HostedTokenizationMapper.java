package com.worldlinesolutions.onlinepayments.example.hostedtokenization;

import com.onlinepayments.domain.*;
import com.worldlinesolutions.onlinepayments.example.hostedcheckout.CreateHostedCheckoutBasicDto;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Component;

import java.math.BigDecimal;
import java.math.RoundingMode;

/**
 * Mapper component used for conversion from Dtos to SDK Domain classes and vice-a-versa
 */
@Component
public class HostedTokenizationMapper {

    /**
     * Converts {@link CreateHostedTokenizationBasicDto} to {@link CreatePaymentRequest}
     * @param createHostedTokenizationBasicDto {@link CreateHostedTokenizationBasicDto}
     * @return Instance of {@link CreatePaymentRequest}
     */
    public CreatePaymentRequest toHostedTokenizationPaymentRequest(CreateHostedTokenizationBasicDto createHostedTokenizationBasicDto) {
        return new CreatePaymentRequest()
                .withOrder(new Order()
                        .withAmountOfMoney(new AmountOfMoney()
                                .withAmount(toAmount(createHostedTokenizationBasicDto.getAmount()))
                                .withCurrencyCode(createHostedTokenizationBasicDto.getCurrency())
                        )
                        .withCustomer(new Customer()
                                .withDevice(new CustomerDevice()
                                        .withAcceptHeader("texthtml,application/xhtml+xml,application/xml;q=0.9,/;q=0.8")
                                        .withBrowserData(new BrowserData()
                                                .withColorDepth(24)
                                                .withJavaEnabled(false)
                                                .withScreenHeight("1200")
                                                .withScreenWidth("1920")
                                        )
                                        .withIpAddress("123.123.123.123")
                                        .withLocale("en_GB")
                                        .withUserAgent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Safari/605.1.15")
                                        .withTimezoneOffsetUtcMinutes("420")
                                )
                        )
                )
                .withHostedTokenizationId(createHostedTokenizationBasicDto.getHostedTokenizationId())
                .withCardPaymentMethodSpecificInput(new CardPaymentMethodSpecificInput()
                        .withAuthorizationMode("SALE")
                );
    }

    private Long toAmount(BigDecimal amount) {
        return amount.multiply(new BigDecimal(100))
                .setScale(0, RoundingMode.HALF_UP)
                .longValue();
    }

}
