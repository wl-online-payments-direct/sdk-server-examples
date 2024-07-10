from flask import request # type: ignore
from hosted_tokenization import hosted_tokenization_mapper, hosted_tokenization_service
from payment import create_payment_service, payment_details_service

def initialize_hosted_tokenization():
    hosted_tokenization_request = hosted_tokenization_service.init_hosted_tokenization()
    return hosted_tokenization_request.to_dictionary()

def create_hosted_tokenization(hosted_tokenization_request_dto):
    hosted_tokenization_request = hosted_tokenization_mapper.to_hosted_tokenization_request(hosted_tokenization_request_dto)
    create_payment_response = create_payment_service.create_payment(hosted_tokenization_request)
    return create_payment_response.to_dictionary()

def outcome():
    paymentId = request.args.get('paymentId')
    payment_details_response = payment_details_service.get_payment_details(paymentId)
    return payment_details_response.to_dictionary()