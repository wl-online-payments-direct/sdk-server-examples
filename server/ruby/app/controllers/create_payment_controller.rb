require_relative '../payment/create_payment_mapper'
require_relative '../payment/create_payment_service'
require_relative '../payment/payment_details_service'
require_relative '../payment/create_payment_basic_dto'
require_relative '../configuration/merchant_client_config'
require 'onlinepayments/sdk'

class CreatePaymentController < ApplicationController

  def initialize_payment
    dto = CreatePaymentMapper.to_empty_dto
    render json: dto.to_h
  end

  def create_payment
    create_payment_basic_dto = CreatePaymentBasicDto.new(
      input_params[:cardNumber],
      input_params[:cardHolder],
      input_params[:expiryMonth],
      input_params[:expiryYear],
      input_params[:cvv],
      input_params[:amount],
      input_params[:currency]
    )

    create_payment_request = CreatePaymentMapper.to_create_payment_request(create_payment_basic_dto)
    create_payment_response = CreatePaymentService.create_payment(create_payment_request)
    render json: create_payment_response
  end

  def outcome
    payment_id = params[:paymentId]

    payment_details_response = PaymentDetailsService.get_payment_details(payment_id)
    render json: payment_details_response
  end

  private

  def input_params
    params.permit(:cardNumber, :cardHolder, :expiryMonth, :expiryYear, :cvv, :amount, :currency)
  end

end
