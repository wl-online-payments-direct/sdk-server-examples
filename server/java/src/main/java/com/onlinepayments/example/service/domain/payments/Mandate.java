package com.onlinepayments.example.service.domain.payments;

import com.onlinepayments.example.service.domain.common.Address;
import com.onlinepayments.example.service.domain.payments.enums.RecurrenceType;
import com.onlinepayments.example.service.domain.payments.enums.SignatureType;

public class Mandate {
    private String iban;
    private String customerReference;
    private String mandateReference;
    private RecurrenceType recurrenceType;
    private SignatureType signatureType;
    private String returnUrl;
    private Address address;

    public Mandate() {}
    public Mandate(String iban, String customerReference, String mandateReference,
                   RecurrenceType recurrenceType, SignatureType signatureType,
                   String returnUrl, Address address) {
        this.iban = iban;
        this.customerReference = customerReference;
        this.mandateReference = mandateReference;
        this.recurrenceType = recurrenceType;
        this.signatureType = signatureType;
        this.returnUrl = returnUrl;
        this.address = address;
    }
    public String getIban() { return iban; }
    public String getCustomerReference() { return customerReference; }
    public String getMandateReference() { return mandateReference; }
    public RecurrenceType getRecurrenceType() { return recurrenceType; }
    public SignatureType getSignatureType() { return signatureType; }
    public String getReturnUrl() { return returnUrl; }
    public Address getAddress() { return address; }

    public void setIban(String iban) {
        this.iban = iban;
    }
    public void setCustomerReference(String customerReference) {
        this.customerReference = customerReference;
    }
    public void setMandateReference(String mandateReference) {
        this.mandateReference = mandateReference;
    }
    public void setRecurrenceType(RecurrenceType recurrenceType) {
        this.recurrenceType = recurrenceType;
    }
    public void setAddress(Address address) {
        this.address = address;
    }
}
