package com.onlinepayments.example.sdk.clients;

import com.onlinepayments.ApiException;
import com.onlinepayments.domain.GetIINDetailsRequest;
import com.onlinepayments.domain.GetIINDetailsResponse;
import com.onlinepayments.example.sdk.mappers.ExceptionMapper;
import com.onlinepayments.example.service.exceptions.SdkException;
import com.onlinepayments.example.service.interfaces.clients.PaymentProductClientInterface;
import com.onlinepayments.merchant.MerchantClient;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Component;

@Component
public class PaymentProductClientImpl implements PaymentProductClientInterface {
    private static final Logger logger = LoggerFactory.getLogger(PaymentProductClientImpl.class);

    private final MerchantClient merchantClient;

    public PaymentProductClientImpl(MerchantClient merchantClient) {
        this.merchantClient = merchantClient;
    }

    @Override
    public Integer getPaymentProductId(String cardNumber) {
        try {
            String card = cardNumber != null && cardNumber.length() >= 6 ? cardNumber.substring(0, 6) : "";
            logger.info("Fetching the payment product id for card number: {}****",
                    card);

            GetIINDetailsRequest request = new GetIINDetailsRequest();
            request.setBin(cardNumber);

            GetIINDetailsResponse response = merchantClient.services().getIINDetails(request);

            if (response.getPaymentProductId() == null) {
                logger.info("No valid payment product id found for card number: {}****",
                        card);
                throw new SdkException("No valid payment product id found for card number", HttpStatus.BAD_REQUEST);
            }

            logger.info("Payment product id: {} returned for card number: {}****",
                    response.getPaymentProductId(),
                    card);

            return response.getPaymentProductId();

        } catch (Exception ex) {
            logger.error("Error occurred while fetching payment product id", ex);
            throw ExceptionMapper.map((ApiException) ex);
        }
    }
}