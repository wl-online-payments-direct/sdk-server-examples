from onlinepayments.sdk.domain.address import Address
from onlinepayments.sdk.domain.amount_of_money import AmountOfMoney
from onlinepayments.sdk.domain.customer import Customer
from onlinepayments.sdk.domain.order import Order
from onlinepayments.sdk.domain.personal_information import PersonalInformation
from onlinepayments.sdk.domain.personal_name import PersonalName
from onlinepayments.sdk.domain.shipping import Shipping
from app.application.domain.enums.common.country import Country
from app.application.dtos.create_payment.request_dto import CreatePaymentRequestDto

class OrderMapper:
    @staticmethod
    def to_sdk_request(dto: CreatePaymentRequestDto):
        order = Order()
        amount = AmountOfMoney()
        amount.amount = dto.amount
        if dto.currency is not None:
            amount.currency_code = dto.currency.to_currency()
        order.amount_of_money = amount

        customer = Customer()
        personal = PersonalInformation()
        name = PersonalName()
        billing = dto.billing_address
        name.first_name = billing.first_name if billing else None
        name.surname = billing.last_name if billing else None
        personal.name = name
        customer.personal_information = personal

        billing_address = Address()
        billing_address.city = billing.city if billing else None
        if billing and billing.country:
            billing_address.country_code = Country.to_iso_alpha2(billing.country)

        billing_address.street = billing.street if billing else None
        billing_address.zip = billing.zip if billing else None
        customer.billing_address = billing_address
        order.customer = customer

        if dto.shipping_address:
            shipping = Shipping()
            shipping_address = Address()
            shipping_address.city = dto.shipping_address.city
            if dto.shipping_address.country:
                shipping_address.country_code = Country.to_iso_alpha2(dto.shipping_address.country)

            shipping_address.street = dto.shipping_address.street
            shipping_address.zip = dto.shipping_address.zip
            shipping.address = shipping_address
            order.shipping = shipping

        return order