package com.worldlinesolutions.onlinepayments.example.hostedcheckout;

import com.onlinepayments.domain.AmountOfMoney;
import com.onlinepayments.domain.CreateHostedCheckoutRequest;
import com.onlinepayments.domain.HostedCheckoutSpecificInput;
import com.onlinepayments.domain.Order;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Component;

import java.math.BigDecimal;
import java.math.RoundingMode;

/**
 * Mapper component used for conversion from Dtos to SDK Domain classes and vice-a-versa
 */
@Component
public class HostedCheckoutMapper {

    @Value("${hostedCheckout.redirectUrl}")
    private String redirectUrl;

    /**
     * Creates an empty {@link CreateHostedCheckoutBasicDto}
     * @return Instance of {@link CreateHostedCheckoutBasicDto}
     */
    public CreateHostedCheckoutBasicDto toEmptyDto(){
        CreateHostedCheckoutBasicDto createHostedCheckoutBasicDto = new CreateHostedCheckoutBasicDto();
        createHostedCheckoutBasicDto.setRedirectUrl(redirectUrl);
        return createHostedCheckoutBasicDto;
    }

    /**
     * Converts {@link CreateHostedCheckoutBasicDto} to {@link CreateHostedCheckoutRequest}
     * @param createHostedCheckoutBasicDto {@link CreateHostedCheckoutBasicDto}
     * @return Instance of {@link CreateHostedCheckoutRequest}
     */
    public CreateHostedCheckoutRequest toCreateHostedCheckoutRequest(CreateHostedCheckoutBasicDto createHostedCheckoutBasicDto) {
        return new CreateHostedCheckoutRequest()
                .withOrder(new Order()
                        .withAmountOfMoney(new AmountOfMoney()
                                .withAmount(toAmount(createHostedCheckoutBasicDto.getAmount()))
                                .withCurrencyCode(createHostedCheckoutBasicDto.getCurrency())
                        )
                )
                .withHostedCheckoutSpecificInput(new HostedCheckoutSpecificInput()
                        .withReturnUrl(createHostedCheckoutBasicDto.getRedirectUrl())
                );
    }

    private Long toAmount(BigDecimal amount) {
        return amount.multiply(new BigDecimal(100))
                .setScale(0, RoundingMode.HALF_UP)
                .longValue();
    }

}
