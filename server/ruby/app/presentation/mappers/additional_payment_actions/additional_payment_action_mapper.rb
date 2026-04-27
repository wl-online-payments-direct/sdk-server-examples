module Presentation
  module Mappers
    module AdditionalPaymentActions
      module AdditionalPaymentActionMapper
        SMALLEST_UNIT = 100
        module_function

        def to_dto(params, id)
          dto = Business::Dtos::AdditionalPaymentActions::RequestDto.new(id: id)

          dto.amount = params[:amount] ? (params[:amount].to_f * SMALLEST_UNIT).to_i : nil
          dto.currency = params[:currency] ? Business::Domain::Enums::Common::Currency.const_get(params[:currency]) : nil
          dto.is_final = params[:is_final]

          dto
        end

        def from_dto(dto)
          return Presentation::Models::AdditionalPaymentActions::Response.new if dto.nil?

          Presentation::Models::AdditionalPaymentActions::Response.new(
            id: dto.id,
            status: dto.status,
            status_output: dto.status_output
          )
        end
      end
    end
  end
end
