package com.worldlinesolutions.onlinepayments.example.payment;

import com.onlinepayments.domain.*;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Component;

import java.math.BigDecimal;
import java.math.RoundingMode;

/**
 * Mapper component used for conversion from Dtos to SDK Domain classes and vice-a-versa
 */
@Component
public class CreatePaymentMapper {

    @Value("${createPayment.3ds.returnUrl}")
    private String returnUrl;

    /**
     * Creates an empty {@link CreatePaymentBasicDto}
     * @return Instance of {@link CreatePaymentBasicDto}
     */
    public CreatePaymentBasicDto toEmptyBasicDto(){
        CreatePaymentBasicDto createPaymentBasicDto = new CreatePaymentBasicDto();

        createPaymentBasicDto.setCardNumber("4012000033330026");
        createPaymentBasicDto.setCardHolder("Willie E. Coyote");
        createPaymentBasicDto.setExpiryMonth("05");
        createPaymentBasicDto.setExpiryYear("29");
        createPaymentBasicDto.setCvv("123");

        return createPaymentBasicDto;
    }

    /**
     * Converts {@link CreatePaymentBasicDto} to {@link CreatePaymentRequest}
     * @param createPaymentBasicDto {@link CreatePaymentBasicDto}
     * @return Instance of {@link CreatePaymentRequest}
     */
    public CreatePaymentRequest toCreatePaymentRequest(CreatePaymentBasicDto createPaymentBasicDto) {
        return new CreatePaymentRequest()
                .withCardPaymentMethodSpecificInput(new CardPaymentMethodSpecificInput()
                        .withCard(new Card()
                                .withCardNumber(createPaymentBasicDto.getCardNumber())
                                .withCardholderName(createPaymentBasicDto.getCardHolder())
                                .withExpiryDate(String.format("%s%s", createPaymentBasicDto.getExpiryMonth(), createPaymentBasicDto.getExpiryYear()))
                                .withCvv(createPaymentBasicDto.getCvv())

                        )
                        .withPaymentProductId(1)
                )
                .withOrder(new Order()
                        .withAmountOfMoney(new AmountOfMoney()
                                .withAmount(toAmount(createPaymentBasicDto.getAmount()))
                                .withCurrencyCode(createPaymentBasicDto.getCurrency())
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
                );
    }

    private Long toAmount(BigDecimal amount) {
        return amount.multiply(new BigDecimal(100))
                .setScale(0, RoundingMode.HALF_UP)
                .longValue();
    }

}
