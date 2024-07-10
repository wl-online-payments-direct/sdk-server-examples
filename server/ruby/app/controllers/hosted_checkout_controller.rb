require_relative '../hosted_checkout/hosted_checkout_mapper'
require_relative '../hosted_checkout/hosted_checkout_service'
require_relative '../payment/payment_details_service'
require_relative '../hosted_checkout/create_hosted_checkout_basic_dto'
require_relative '../configuration/merchant_client_config'
require_relative '../services/payment_utils'
require 'onlinepayments/sdk'

class HostedCheckoutController < ApplicationController

  def initialize_hosted_checkout
    dto = HostedCheckoutMapper.to_empty_dto
    render json: dto.to_h
  end

  def create_hosted_checkout
    create_hosted_checkout_basic_dto = CreateHostedCheckoutBasicDto.new(
      input_params[:amount],
      input_params[:currency],
      input_params[:redirectUrl]
    )

    create_hosted_checkout_request = HostedCheckoutMapper.to_create_hosted_checkout_request(create_hosted_checkout_basic_dto)
    create_hosted_checkout_response = HostedCheckoutService.create_hosted_checkout(create_hosted_checkout_request)
    render json: PaymentUtils.to_camel_case_keys(create_hosted_checkout_response.to_h)
  end

  def outcome
    hosted_checkout_id = params[:hostedCheckoutId]

    payment_details_response = PaymentDetailsService.get_payment_details_for_hosted_checkout(hosted_checkout_id)
    render json: payment_details_response
  end

  private

  def input_params
    params.permit(:amount, :currency, :redirectUrl)
  end

end
