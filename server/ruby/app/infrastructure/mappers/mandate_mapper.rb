module Infrastructure
  module Mappers
    module MandateMapper
      module_function

      def to_sdk_request(request_dto)
        mandate = request_dto&.mandate

        create_mandate = OnlinePayments::SDK::Domain::CreateMandateRequest.new

        customer = OnlinePayments::SDK::Domain::MandateCustomer.new

        bank_account_iban = OnlinePayments::SDK::Domain::BankAccountIban.new
        bank_account_iban.iban = mandate&.iban
        customer.bank_account_iban = bank_account_iban

        address = OnlinePayments::SDK::Domain::MandateAddress.new
        if mandate&.address&.country
          address.country_code = Business::Extensions::Models::CountryExtension.to_iso_alpha2(mandate.address.country)
        end
        address.city = mandate&.address&.city
        address.street = mandate&.address&.street
        address.zip = mandate&.address&.zip
        customer.mandate_address = address

        personal_information = OnlinePayments::SDK::Domain::MandatePersonalInformation.new
        name = OnlinePayments::SDK::Domain::MandatePersonalName.new
        name.first_name = mandate&.address&.first_name
        name.surname = mandate&.address&.last_name
        personal_information.name = name
        customer.personal_information = personal_information

        create_mandate.customer = customer

        create_mandate.customer_reference = mandate&.customer_reference
        create_mandate.recurrence_type = mandate&.recurrence_type
        create_mandate.return_url = mandate&.return_url
        create_mandate.signature_type = mandate&.signature_type

        create_mandate
      end

      def from_sdk_get_response(get_mandate_response)
        return nil if get_mandate_response&.mandate.nil?

        Business::Dtos::Mandate::GetMandateResponseDto.new(
          get_mandate_response.mandate.unique_mandate_reference
        )
      end

      def from_sdk_create_response(create_mandate_response)
        mandate = Business::Domain::Payments::Mandate.new

        mandate.iban = create_mandate_response.mandate.customer.bank_account_iban.iban
        mandate.customer_reference = create_mandate_response.mandate.customer_reference
        mandate.return_url = create_mandate_response.merchant_action.redirect_data.redirect_url

        mandate
      end
    end
  end
end