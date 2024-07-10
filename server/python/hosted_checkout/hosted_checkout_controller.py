from flask import request # type: ignore
from hosted_checkout import hosted_checkout_mapper, hosted_checkout_service
from payment import payment_details_service

def initialize_hosted_checkout():
    return hosted_checkout_mapper.to_empty_dto()

def create_hosted_checkout(hosted_checkout_request_dto):
    hosted_checkout_request = hosted_checkout_mapper.to_hosted_checkout_request(hosted_checkout_request_dto)
    hosted_checkout_response = hosted_checkout_service.create_hosted_checkout(hosted_checkout_request)
    return hosted_checkout_response.to_dictionary()

def outcome():
    hostedCheckoutId = request.args.get('hostedCheckoutId')
    payment_details_response = payment_details_service.get_payment_details_for_hosted_checkout(hostedCheckoutId)
    return payment_details_response.to_dictionary()