package com.onlinepayments.example.sdk.mappers;

import com.onlinepayments.domain.CreateMandateRequest;
import com.onlinepayments.domain.GetMandateResponse;
import com.onlinepayments.domain.MandateResponse;
import com.onlinepayments.example.service.domain.payments.Mandate;
import com.onlinepayments.example.service.dtos.mandates.CreateMandateRequestDto;
import com.onlinepayments.example.service.dtos.mandates.GetMandateResponseDto;
import com.onlinepayments.example.service.utilities.EnumMapper;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;

@Mapper(componentModel = "spring", uses = {EnumMapper.class})
public interface MandateMapper {
    @Mapping(target = "customer.bankAccountIban.iban", source = "mandate.iban")
    @Mapping(target = "customer.mandateAddress.countryCode", source = "mandate.address.country")
    @Mapping(target = "customer.mandateAddress.city", source = "mandate.address.city")
    @Mapping(target = "customer.mandateAddress.street", source = "mandate.address.street")
    @Mapping(target = "customer.mandateAddress.zip", source = "mandate.address.zip")
    @Mapping(target = "customer.personalInformation.name.firstName", source = "mandate.address.firstName")
    @Mapping(target = "customer.personalInformation.name.surname", source = "mandate.address.lastName")
    @Mapping(target = "customerReference", source = "mandate.customerReference")
    @Mapping(target = "recurrenceType", source = "mandate.recurrenceType")
    @Mapping(target = "returnUrl", source = "mandate.returnUrl")
    @Mapping(target = "signatureType", source = "mandate.signatureType")
    CreateMandateRequest toSdkCreateRequest(CreateMandateRequestDto dto);

    @Mapping(target = "customerReference", source = "customerReference")
    @Mapping(target = "iban", source = "customer.bankAccountIban.iban")
    @Mapping(target = "recurrenceType", source = "recurrenceType")
    @Mapping(target = "mandateReference", source = "uniqueMandateReference")
    @Mapping(target = "address.firstName", source = "customer.personalInformation.name.firstName")
    @Mapping(target = "address.lastName", source = "customer.personalInformation.name.surname")
    @Mapping(target = "address.city", source = "customer.mandateAddress.city")
    @Mapping(target = "address.street", source = "customer.mandateAddress.street")
    @Mapping(target = "address.zip", source = "customer.mandateAddress.zip")
    Mandate toMandateDto(MandateResponse response);

    @Mapping(target = "uniqueMandateReference", source = "mandate.uniqueMandateReference")
    GetMandateResponseDto toGetMandateResponseDto(GetMandateResponse response);
}
