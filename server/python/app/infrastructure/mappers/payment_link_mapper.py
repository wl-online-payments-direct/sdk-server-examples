import secrets
from datetime import datetime, timezone, timedelta
from onlinepayments.sdk.domain.amount_of_money import AmountOfMoney
from onlinepayments.sdk.domain.create_payment_link_request import CreatePaymentLinkRequest
from onlinepayments.sdk.domain.order import Order
from onlinepayments.sdk.domain.order_references import OrderReferences
from onlinepayments.sdk.domain.payment_link_response import PaymentLinkResponse
from onlinepayments.sdk.domain.payment_link_specific_input import PaymentLinkSpecificInput
from app.application.domain.enums.common.currency import Currency
from app.application.domain.enums.common.status import Status
from app.application.dtos.payment_link.request_dto import CreatePaymentLinkRequestDto
from app.application.dtos.payment_link.response_dto import CreatePaymentLinkResponseDto

SMALLEST_UNIT = 100

class PaymentLinkMapper:

    @staticmethod
    def to_sdk_request(request_dto: CreatePaymentLinkRequestDto) -> CreatePaymentLinkRequest:
        sdk_request = CreatePaymentLinkRequest()

        order = Order()

        amount = AmountOfMoney()
        amount.amount = int(request_dto.amount * SMALLEST_UNIT)
        amount.currency_code = request_dto.currency.to_currency()
        order.amount_of_money = amount

        order_references = OrderReferences()
        order_references.merchant_reference = secrets.token_hex(16)
        order.references = order_references

        sdk_request.order = order

        payment_link_specific_input = PaymentLinkSpecificInput()

        if request_dto.description:
            payment_link_specific_input.description = request_dto.description

        if request_dto.valid_for:
            expiration = datetime.now(timezone.utc) + timedelta(hours=request_dto.valid_for.value)
            payment_link_specific_input.expiration_date = expiration

        sdk_request.payment_link_specific_input = payment_link_specific_input

        return sdk_request

    @staticmethod
    def from_sdk_response(response: PaymentLinkResponse) -> CreatePaymentLinkResponseDto:
        currency = None
        if response and response.payment_link_order and response.payment_link_order.amount:
            currency_code = response.payment_link_order.amount.currency_code
            if currency_code:
                try:
                    currency = Currency(currency_code.upper())
                except ValueError:
                    currency = None

        status = None
        if response and response.status:
            status = Status.try_from(response.status)

        return CreatePaymentLinkResponseDto(
            redirect_url=response.redirection_url if response else '',
            payment_link_id=response.payment_link_id if response else None,
            status=status,
            amount=response.payment_link_order.amount.amount if response and response.payment_link_order and response.payment_link_order.amount else None,
            currency=currency
        )