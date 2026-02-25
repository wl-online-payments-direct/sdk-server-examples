package com.onlinepayments.example.service.handlers;

import com.onlinepayments.example.service.domain.payments.Mandate;
import com.onlinepayments.example.service.domain.payments.enums.PaymentMethodType;
import com.onlinepayments.example.service.dtos.mandates.CreateMandateRequestDto;
import com.onlinepayments.example.service.dtos.mandates.GetMandateResponseDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentRequestDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentResponseDto;
import com.onlinepayments.example.service.interfaces.clients.MandateClientInterface;
import com.onlinepayments.example.service.interfaces.clients.PaymentClientInterface;
import com.onlinepayments.example.service.interfaces.handlers.PaymentMethodHandlerInterface;
import org.springframework.stereotype.Component;

@Component
public class DirectDebitPaymentHandler implements PaymentMethodHandlerInterface {

    private static final int DIRECT_DEBIT_PRODUCT_ID = 771;

    private final PaymentClientInterface paymentClient;
    private final MandateClientInterface mandateClient;

    public DirectDebitPaymentHandler(PaymentClientInterface paymentClient,
                                     MandateClientInterface mandateClient) {
        this.paymentClient = paymentClient;
        this.mandateClient = mandateClient;
    }

    @Override
    public boolean isPaymentMethodSupported(PaymentMethodType method) {
        return method == PaymentMethodType.DIRECT_DEBIT;
    }

    @Override
    public CreatePaymentResponseDto createPayment(CreatePaymentRequestDto requestDto) {
        return paymentClient.createPayment(handleDirectDebit(requestDto));
    }

    private CreatePaymentRequestDto handleDirectDebit(CreatePaymentRequestDto requestDto) {
        GetMandateResponseDto existingMandate = null;

        if (requestDto.getMandate() != null && requestDto.getMandate().getMandateReference() != null
                && !requestDto.getMandate().getMandateReference().isEmpty()) {
            existingMandate = mandateClient.getMandate(requestDto.getMandate().getMandateReference());
        }

        if (existingMandate == null) {
            Mandate newMandate = mandateClient.createMandate(new CreateMandateRequestDto(requestDto.getMandate()));
            requestDto.setMandate(newMandate);
        } else {
            requestDto.getMandate().setMandateReference(existingMandate.uniqueMandateReference());
        }

        requestDto.setPaymentProductId(DIRECT_DEBIT_PRODUCT_ID);

        return requestDto;
    }
}
