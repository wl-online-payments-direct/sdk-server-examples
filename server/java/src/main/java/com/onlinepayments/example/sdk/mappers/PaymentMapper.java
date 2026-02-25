package com.onlinepayments.example.sdk.mappers;

import com.onlinepayments.domain.*;
import com.onlinepayments.example.service.domain.common.StatusOutput;
import com.onlinepayments.example.service.domain.common.enums.Status;
import com.onlinepayments.example.service.domain.common.enums.StatusCategory;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentRequestDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentResponseDto;
import com.onlinepayments.example.service.utilities.EnumMapper;
import org.springframework.stereotype.Component;

@Component
public class PaymentMapper {
    private final EnumMapper enumMapper;

    private static final int SMALLEST_UNIT = 100;

    public PaymentMapper(EnumMapper enumMapper) {
        this.enumMapper = enumMapper;
    }

    public CreatePaymentRequest map(CreatePaymentRequestDto requestDto) {
        if (requestDto == null) {
            return null;
        }

        CreatePaymentRequest request = new CreatePaymentRequest();
        Order order = new Order();
        AmountOfMoney amount = new AmountOfMoney();

        amount.setAmount(requestDto.getAmount() != null ? requestDto.getAmount().longValue() * SMALLEST_UNIT : null);
        amount.setCurrencyCode(requestDto.getCurrency() != null ? requestDto.getCurrency().name() : null);

        order.setAmountOfMoney(amount);

        Customer customer = new Customer();
        PersonalInformation personalInformation = new PersonalInformation();

        if (requestDto.getBillingAddress() != null) {
            PersonalName personalName = new PersonalName();

            personalName.setFirstName(requestDto.getBillingAddress().firstName());
            personalName.setSurname(requestDto.getBillingAddress().lastName());

            Address billingAddress = new Address();
            billingAddress.setCity(requestDto.getBillingAddress().city());
            billingAddress.setCountryCode(enumMapper.map(requestDto.getBillingAddress().country()));
            billingAddress.setStreet(requestDto.getBillingAddress().street());
            billingAddress.setZip(requestDto.getBillingAddress().zip());
            customer.setBillingAddress(billingAddress);
            personalInformation.setName(personalName);
        }

        customer.setPersonalInformation(personalInformation);
        order.setCustomer(customer);

        if (requestDto.getShippingAddress() != null) {
            Shipping shipping = new Shipping();
            AddressPersonal shippingAddress = new AddressPersonal();
            PersonalName personalName = new PersonalName();

            personalName.setFirstName(requestDto.getShippingAddress().firstName());
            personalName.setSurname(requestDto.getShippingAddress().lastName());

            shippingAddress.setCity(requestDto.getShippingAddress().city());
            shippingAddress.setCountryCode(enumMapper.map(requestDto.getShippingAddress().country()));
            shippingAddress.setStreet(requestDto.getShippingAddress().street());
            shippingAddress.setZip(requestDto.getShippingAddress().zip());
            shippingAddress.setName(personalName);
            shipping.setAddress(shippingAddress);
            order.setShipping(shipping);
        }

        request.setOrder(order);

        if (requestDto.getMethod() != null) {
            switch (requestDto.getMethod()) {
                case CREDIT_CARD -> {
                    CardPaymentMethodSpecificInput cardInput = getCardPaymentMethodSpecificInput(requestDto);

                    request.setCardPaymentMethodSpecificInput(cardInput);
                }

                case TOKEN -> request.setHostedTokenizationId(requestDto.getHostedTokenizationId());

                case DIRECT_DEBIT -> {
                    SepaDirectDebitPaymentMethodSpecificInput directDebitInput = new SepaDirectDebitPaymentMethodSpecificInput();
                    directDebitInput.setPaymentProductId(requestDto.getPaymentProductId());

                    SepaDirectDebitPaymentProduct771SpecificInput product771Input = new SepaDirectDebitPaymentProduct771SpecificInput();

                    if (requestDto.getMandate() != null) {
                        product771Input.setExistingUniqueMandateReference(requestDto.getMandate().getMandateReference());
                    }

                    directDebitInput.setPaymentProduct771SpecificInput(product771Input);
                    request.setSepaDirectDebitPaymentMethodSpecificInput(directDebitInput);
                }
            }
        }

        return request;
    }

    private CardPaymentMethodSpecificInput getCardPaymentMethodSpecificInput(CreatePaymentRequestDto requestDto) {
        CardPaymentMethodSpecificInput cardInput = new CardPaymentMethodSpecificInput();

        cardInput.setPaymentProductId(requestDto.getPaymentProductId());

        if (requestDto.getCard() != null) {
            Card card = new Card();
            card.setCardNumber(requestDto.getCard().number());
            card.setCardholderName(requestDto.getCard().holderName());

            if (requestDto.getCard().expiryMonth() != null && requestDto.getCard().expiryYear() != null) {
                card.setExpiryDate(requestDto.getCard().expiryMonth() + requestDto.getCard().expiryYear().substring(2));
            }

            card.setCvv(requestDto.getCard().verificationCode());
            cardInput.setCard(card);
        }

        ThreeDSecure threeDSecure = new ThreeDSecure();
        threeDSecure.setSkipAuthentication(true);
        cardInput.setThreeDSecure(threeDSecure);

        return cardInput;
    }

    public CreatePaymentResponseDto map(CreatePaymentResponse response) {
        if (response == null || response.getPayment() == null) {
            return null;
        }

        Status status = null;

        if (response.getPayment().getStatus() != null) {
            status = Status.valueOf(response.getPayment().getStatus().toUpperCase());
        }

        StatusCategory statusCategory = null;

        if (response.getPayment().getStatusOutput() != null &&
                response.getPayment().getStatusOutput().getStatusCategory() != null) {
            statusCategory = StatusCategory.valueOf(response.getPayment().getStatusOutput().getStatusCategory().toUpperCase());
        }

        return new CreatePaymentResponseDto(response.getPayment().getId(),
                status,
                new StatusOutput(response.getPayment().getStatusOutput().getStatusCode(), statusCategory));
    }
}
