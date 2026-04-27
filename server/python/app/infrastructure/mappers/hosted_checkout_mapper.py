from onlinepayments.sdk.domain.address import Address
from onlinepayments.sdk.domain.address_personal import AddressPersonal
from onlinepayments.sdk.domain.amount_of_money import AmountOfMoney
from onlinepayments.sdk.domain.create_hosted_checkout_request import CreateHostedCheckoutRequest
from onlinepayments.sdk.domain.create_hosted_checkout_response import CreateHostedCheckoutResponse
from onlinepayments.sdk.domain.customer import Customer
from onlinepayments.sdk.domain.get_hosted_checkout_response import GetHostedCheckoutResponse
from onlinepayments.sdk.domain.hosted_checkout_specific_input import HostedCheckoutSpecificInput
from onlinepayments.sdk.domain.order import Order
from onlinepayments.sdk.domain.personal_information import PersonalInformation
from onlinepayments.sdk.domain.personal_name import PersonalName
from onlinepayments.sdk.domain.shipping import Shipping
from app.application.domain.enums.common.country import Country
from app.application.dtos.hosted_checkout.request_dto import CreateHostedCheckoutRequestDto
from app.application.dtos.hosted_checkout.response_dto import CreateHostedCheckoutResponseDto
from app.application.dtos.get_payment_by_hosted_checkout_id.response_dto import GetPaymentByHostedCheckoutIdResponseDto

class HostedCheckoutMapper:

    @staticmethod
    def to_sdk_request(request_dto: CreateHostedCheckoutRequestDto) -> CreateHostedCheckoutRequest:
        sdk_request = CreateHostedCheckoutRequest()

        order = Order()

        amount = AmountOfMoney()
        amount.amount = request_dto.amount
        if request_dto.currency is not None:
            amount.currency_code = request_dto.currency.to_currency()
        order.amount_of_money = amount

        customer = Customer()

        if request_dto.billing_address:
            personal_information = PersonalInformation()
            name = PersonalName()
            name.first_name = request_dto.billing_address.first_name
            name.surname = request_dto.billing_address.last_name
            personal_information.name = name
            customer.personal_information = personal_information

            billing_address = Address()
            billing_address.city = request_dto.billing_address.city
            if request_dto.billing_address.country is not None:
                billing_address.country_code = Country.to_iso_alpha2(request_dto.billing_address.country)
            billing_address.street = request_dto.billing_address.street
            billing_address.zip = request_dto.billing_address.zip
            customer.billing_address = billing_address

        order.customer = customer

        if request_dto.shipping_address:
            shipping = Shipping()
            shipping_address = AddressPersonal()
            shipping_address.city = request_dto.shipping_address.city
            if request_dto.shipping_address.country is not None:
                shipping_address.country_code = Country.to_iso_alpha2(request_dto.shipping_address.country)
            shipping_address.street = request_dto.shipping_address.street
            shipping_address.zip = request_dto.shipping_address.zip

            shipping_name = PersonalName()
            shipping_name.first_name = request_dto.shipping_address.first_name
            shipping_name.surname = request_dto.shipping_address.last_name
            shipping_address.name = shipping_name

            shipping.address = shipping_address
            order.shipping = shipping

        sdk_request.order = order

        hosted_checkout_specific_input = HostedCheckoutSpecificInput()
        hosted_checkout_specific_input.return_url = request_dto.redirect_url
        hosted_checkout_specific_input.locale = request_dto.language.to_locale()
        sdk_request.hosted_checkout_specific_input = hosted_checkout_specific_input

        return sdk_request

    @staticmethod
    def from_sdk_create_response(sdk_response: CreateHostedCheckoutResponse) -> CreateHostedCheckoutResponseDto:
        return CreateHostedCheckoutResponseDto(
            hosted_checkout_id=sdk_response.hosted_checkout_id,
            redirect_url=sdk_response.redirect_url,
            return_mac=sdk_response.returnmac
        )

    @staticmethod
    def from_sdk_get_response(response: GetHostedCheckoutResponse) -> GetPaymentByHostedCheckoutIdResponseDto:
        dto = GetPaymentByHostedCheckoutIdResponseDto()
        dto.status = getattr(response, 'status', None)
        dto.payment_id = getattr(response, 'created_payment_output', None) and \
                         response.created_payment_output.payment and \
                         response.created_payment_output.payment.id
        return dto