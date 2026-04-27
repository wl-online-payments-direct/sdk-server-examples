module Business
  module Domain
    module Payments
      class Mandate
        attr_accessor :iban,
                      :customer_reference,
                      :mandate_reference,
                      :recurrence_type,
                      :signature_type,
                      :return_url,
                      :address

        def initialize(iban: nil,
                       customer_reference: nil,
                       mandate_reference: nil,
                       recurrence_type: nil,
                       signature_type: nil,
                       return_url: nil,
                       address: nil)
          @iban = iban
          @customer_reference = customer_reference
          @mandate_reference = mandate_reference
          @recurrence_type = recurrence_type
          @signature_type = signature_type
          @return_url = return_url
          @address = address
        end

        def self.from_sdk_hash(hash)
          return nil unless hash.is_a?(Hash)

          recurrence_type = Business::Domain::Enums::Payments::RecurrenceType.try_from(hash[:recurrence_type])
          signature_type = Business::Domain::Enums::Payments::SignatureType.try_from(hash[:signature_type])

          new(
            iban: hash[:iban],
            customer_reference: hash[:customer_reference],
            mandate_reference: hash[:mandate_reference],
            recurrence_type: recurrence_type,
            signature_type: signature_type,
            return_url: hash[:return_url],
            address: hash[:address] ? Business::Dtos::Common::Address.from_sdk_hash(hash[:address]) : nil
          )
        end

        def to_sdk_hash
          {
            'iban' => @iban,
            'customerReference' => @customer_reference,
            'mandateReference' => @mandate_reference,
            'recurrenceType' => @recurrence_type,
            'signatureType' => @signature_type,
            'returnUrl' => @return_url,
            'address' => @address&.to_h
          }
        end
      end
    end
  end
end