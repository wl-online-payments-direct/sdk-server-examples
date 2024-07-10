from flask import request # type: ignore
from payment import create_payment_mapper, create_payment_service, payment_details_service

def initialize_payment():
    return create_payment_mapper.to_empty_dto()

def create_payment(payment_request_dto):
    create_payment_request = create_payment_mapper.to_payment_request(payment_request_dto)
    create_payment_response = create_payment_service.create_payment(create_payment_request)
    return create_payment_response.to_dictionary()

def outcome():
    payment_id = request.args.get('paymentId')
    payment_details_response = payment_details_service.get_payment_details(payment_id)
    return payment_details_response.to_dictionary()