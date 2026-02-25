package com.onlinepayments.example.sdk.mappers;

import com.onlinepayments.domain.CreatePaymentLinkRequest;
import com.onlinepayments.domain.PaymentLinkResponse;
import com.onlinepayments.example.service.domain.paymentlinks.ValidityPeriod;
import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkRequestDto;
import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkResponseDto;
import com.onlinepayments.example.service.utilities.EnumMapper;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import org.mapstruct.Mappings;
import org.mapstruct.Named;

import java.time.ZonedDateTime;

@Mapper(componentModel = "spring", uses = {EnumMapper.class})
public interface PaymentLinkMapper {
    @Mappings({
            @Mapping(target = "order.amountOfMoney.amount", source = "amount"),
            @Mapping(target = "order.amountOfMoney.currencyCode", source = "currency"),
            @Mapping(target = "paymentLinkSpecificInput.description", source = "description"),
            @Mapping(target = "paymentLinkSpecificInput.expirationDate", source = "validFor", qualifiedByName = "mapValidity"),
            @Mapping(target = "order.references.merchantReference", expression = "java(java.util.UUID.randomUUID().toString())")

    })
    CreatePaymentLinkRequest toSdkRequest(CreatePaymentLinkRequestDto dto);

    @Mappings({
            @Mapping(target = "paymentLinkId", source = "paymentLinkId"),
            @Mapping(target = "redirectUrl", source = "redirectionUrl"),
            @Mapping(target = "status", source = "status"),
            @Mapping(target = "amount", source = "paymentLinkOrder.amount.amount"),
            @Mapping(target = "currency", source = "paymentLinkOrder.amount.currencyCode")
    })
    CreatePaymentLinkResponseDto toResponseDto(PaymentLinkResponse response);

    @Named("mapValidity")
    default ZonedDateTime mapValidity(ValidityPeriod validFor) {
        if (validFor == null) {
            return null;
        }

        ZonedDateTime now = ZonedDateTime.now();

        return switch (validFor) {
            case OneDay -> now.plusDays(1);
            case TwoDays -> now.plusDays(2);
            case TwoWeeks -> now.plusWeeks(2);
            case OneMonth -> now.plusMonths(1);
        };
    }
}
