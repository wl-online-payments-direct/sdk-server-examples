require_relative '../hosted_tokenization/hosted_tokenization_mapper'
require_relative '../hosted_tokenization/hosted_tokenization_service'
require_relative '../payment/create_payment_service'
require_relative '../payment/payment_details_service'
require_relative '../configuration/merchant_client_config'
require_relative '../services/payment_utils'
require 'onlinepayments/sdk'


class HostedTokenizationController < ApplicationController

  def initialize_hosted_tokenization
    dto = HostedTokenizationService.init_hosted_tokenization()
    render json: PaymentUtils.to_camel_case_keys(dto.to_h)
  end

  def create_hosted_tokenization
    create_hosted_tokenization_basic_dto = CreateHostedTokenizationBasicDto.new(
      input_params[:amount],
      input_params[:currency],
      input_params[:hostedTokenizationId]
    )

    create_payment_request = HostedTokenizationMapper.to_hosted_tokenization_payment_request(create_hosted_tokenization_basic_dto)
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
    params.permit(:amount, :currency, :redirectUrl)
  end

end
