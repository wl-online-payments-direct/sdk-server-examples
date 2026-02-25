package com.onlinepayments.example.sdk.mappers;

import com.onlinepayments.domain.*;
import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionRequestDto;
import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionResponseDto;
import com.onlinepayments.example.service.utilities.EnumMapper;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import org.mapstruct.Mappings;

import java.math.BigDecimal;

@Mapper(componentModel = "spring", uses = {EnumMapper.class})
public interface AdditionalPaymentActionMapper {
    @Mappings({
            @Mapping(target = "amount", source = "amount"),
            @Mapping(target = "isFinal", source = "isFinal")
    })
    default CapturePaymentRequest toSdkCaptureRequest(AdditionalPaymentActionRequestDto dto) {
        if (dto == null) {
            return null;
        }

        CapturePaymentRequest request = new CapturePaymentRequest();
        request.setAmount(toMinorUnit(dto.amount()));
        request.setIsFinal(dto.isFinal());

        return request;
    }

    @Mappings({
            @Mapping(target = "amountOfMoney.amount", source = "amount"),
            @Mapping(target = "amountOfMoney.currencyCode", source = "currency")
    })
    default RefundRequest toSdkRefundRequest(AdditionalPaymentActionRequestDto dto) {
        if (dto == null) {
            return null;
        }

        RefundRequest request = new RefundRequest();
        AmountOfMoney amountOfMoney = new AmountOfMoney();
        amountOfMoney.setAmount(toMinorUnit(dto.amount()));
        amountOfMoney.setCurrencyCode(String.valueOf(dto.currency()));

        request.setAmountOfMoney(amountOfMoney);

        return request;
    }

    @Mappings({
            @Mapping(target = "amountOfMoney.amount", source = "amount"),
            @Mapping(target = "amountOfMoney.currencyCode", source = "currency"),
            @Mapping(target = "isFinal", source = "isFinal")
    })
    default CancelPaymentRequest toSdkCancelRequest(AdditionalPaymentActionRequestDto dto) {
        if (dto == null) {
            return null;
        }

        CancelPaymentRequest request = new CancelPaymentRequest();
        AmountOfMoney amountOfMoney = new AmountOfMoney();
        amountOfMoney.setAmount(toMinorUnit(dto.amount()));
        amountOfMoney.setCurrencyCode(String.valueOf(dto.currency()));

        request.setAmountOfMoney(amountOfMoney);
        request.setIsFinal(dto.isFinal());

        return request;
    }

    @Mappings({
            @Mapping(target = "id", source = "id"),
            @Mapping(target = "status", source = "status"),
            @Mapping(target = "statusOutput.statusCode", source = "statusOutput.statusCode")
    })
    AdditionalPaymentActionResponseDto toCaptureResponseDto(CaptureResponse response);

    @Mappings({
            @Mapping(target = "id", source = "id"),
            @Mapping(target = "status", source = "status"),
            @Mapping(target = "statusOutput.statusCode", source = "statusOutput.statusCode"),
            @Mapping(target = "statusOutput.statusCategory", source = "statusOutput.statusCategory")
    })
    AdditionalPaymentActionResponseDto toRefundResponseDto(RefundResponse response);

    @Mappings({
            @Mapping(target = "id", source = "payment.id"),
            @Mapping(target = "status", source = "payment.status"),
            @Mapping(target = "statusOutput.statusCode", source = "payment.statusOutput.statusCode"),
            @Mapping(target = "statusOutput.statusCategory", source = "payment.statusOutput.statusCategory")
    })
    AdditionalPaymentActionResponseDto toCancelResponseDto(CancelPaymentResponse response);

    default Long toMinorUnit(BigDecimal amount) {
        if (amount == null) {
            return null;
        }

        return amount.multiply(BigDecimal.valueOf(100)).longValue();
    }
}
