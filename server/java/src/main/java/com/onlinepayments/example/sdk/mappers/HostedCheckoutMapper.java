package com.onlinepayments.example.sdk.mappers;

import com.onlinepayments.domain.CreateHostedCheckoutRequest;
import com.onlinepayments.domain.CreateHostedCheckoutResponse;
import com.onlinepayments.domain.GetHostedCheckoutResponse;
import com.onlinepayments.example.service.dtos.hostedcheckout.CreateHostedCheckoutRequestDto;
import com.onlinepayments.example.service.dtos.hostedcheckout.CreateHostedCheckoutResponseDto;
import com.onlinepayments.example.service.dtos.paymentbyhostedcheckoutid.GetPaymentByHostedCheckoutIdResponseDto;
import com.onlinepayments.example.service.utilities.EnumMapper;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import org.mapstruct.Mappings;

@Mapper(componentModel = "spring", uses = {EnumMapper.class})
public interface HostedCheckoutMapper {
    @Mappings({
            @Mapping(target = "order.amountOfMoney.amount", source = "amount"),
            @Mapping(target = "order.amountOfMoney.currencyCode", source = "currency"),
            @Mapping(target = "hostedCheckoutSpecificInput.returnUrl", source = "redirectUrl"),
            @Mapping(target = "hostedCheckoutSpecificInput.locale", source = "language"),
            @Mapping(target = "order.customer.personalInformation.name.firstName", source = "billingAddress.firstName"),
            @Mapping(target = "order.customer.personalInformation.name.surname", source = "billingAddress.lastName"),
            @Mapping(target = "order.customer.billingAddress.city", source = "billingAddress.city"),
            @Mapping(target = "order.customer.billingAddress.countryCode", source = "billingAddress.country"),
            @Mapping(target = "order.customer.billingAddress.street", source = "billingAddress.street"),
            @Mapping(target = "order.customer.billingAddress.zip", source = "billingAddress.zip"),
            @Mapping(target = "order.shipping.address.city", source = "shippingAddress.city"),
            @Mapping(target = "order.shipping.address.countryCode", source = "shippingAddress.country"),
            @Mapping(target = "order.shipping.address.street", source = "shippingAddress.street"),
            @Mapping(target = "order.shipping.address.zip", source = "shippingAddress.zip"),
            @Mapping(target = "order.shipping.address.name.firstName", source = "shippingAddress.firstName"),
            @Mapping(target = "order.shipping.address.name.surname", source = "shippingAddress.lastName")
    })
    CreateHostedCheckoutRequest toSdkRequest(CreateHostedCheckoutRequestDto dto);

    @Mappings({
            @Mapping(target = "hostedCheckoutId", source = "hostedCheckoutId"),
            @Mapping(target = "redirectUrl", source = "redirectUrl"),
            @Mapping(target = "returnMAC", source = "RETURNMAC"),
    })
    CreateHostedCheckoutResponseDto toCreateResponseDto(CreateHostedCheckoutResponse response);

    @Mappings({
            @Mapping(target = "status", source = "status"),
            @Mapping(target = "paymentId", source = "createdPaymentOutput.payment.id")
    })
    GetPaymentByHostedCheckoutIdResponseDto toGetPaymentResponseDto(GetHostedCheckoutResponse response);
}
