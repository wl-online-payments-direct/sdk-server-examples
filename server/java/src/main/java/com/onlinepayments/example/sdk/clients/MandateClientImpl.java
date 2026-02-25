package com.onlinepayments.example.sdk.clients;

import com.onlinepayments.domain.CreateMandateResponse;
import com.onlinepayments.domain.GetMandateResponse;
import com.onlinepayments.example.sdk.mappers.ExceptionMapper;
import com.onlinepayments.example.sdk.mappers.MandateMapper;
import com.onlinepayments.example.service.domain.payments.Mandate;
import com.onlinepayments.example.service.dtos.mandates.CreateMandateRequestDto;
import com.onlinepayments.example.service.dtos.mandates.GetMandateResponseDto;
import com.onlinepayments.example.service.interfaces.clients.MandateClientInterface;
import com.onlinepayments.merchant.MerchantClient;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Component;

@Component
public class MandateClientImpl implements MandateClientInterface {
    private static final Logger logger = LoggerFactory.getLogger(MandateClientImpl.class);
    private final MerchantClient merchantClient;
    private final MandateMapper mandateMapper;

    public MandateClientImpl(MerchantClient merchantClient, MandateMapper mandateMapper) {
        this.merchantClient = merchantClient;
        this.mandateMapper = mandateMapper;
    }

    @Override
    public Mandate createMandate(CreateMandateRequestDto requestDto) {
        try {
            logger.info("Creating mandate.");

            CreateMandateResponse response = merchantClient.mandates().createMandate(mandateMapper.toSdkCreateRequest(requestDto));

            logger.info("Successful mandate with unique mandate reference: {}",
                    response.getMandate().getUniqueMandateReference());

            return mandateMapper.toMandateDto(response.getMandate());
        } catch (Exception ex) {
            logger.error("Error occurred while creating mandate.", ex);
            throw ExceptionMapper.map(ex);
        }
    }

    @Override
    public GetMandateResponseDto getMandate(String existingUniqueMandateReference) {
        try {
            logger.info("Getting mandate.");
            GetMandateResponse response = merchantClient.mandates().getMandate(existingUniqueMandateReference);
            logger.info("Mandate retrieved successfully.");

            return mandateMapper.toGetMandateResponseDto(response);
        } catch (Exception ex) {
            logger.error("Error occurred while getting mandate.", ex);
            throw ExceptionMapper.map(ex);
        }
    }
}
