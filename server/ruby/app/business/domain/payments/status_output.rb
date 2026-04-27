module Business
  module Domain
    module Payments
      class StatusOutput
        attr_accessor :status_code, :status_category

        def initialize(status_code: nil, status_category: nil)
          @status_code = status_code
          @status_category = status_category
        end

        def self.from_sdk_hash(hash)
          return nil unless hash.is_a?(Hash)

          category = hash['status_category'] ? Business::Domain::Enums::Common::StatusCategory.from_hash(hash['status_category']) : nil

          new(
            status_code: hash['status_code'],
            status_category: category
          )
        end

        def to_sdk_hash
          {
            'statusCode' => @status_code,
            'statusCategory' => @status_category&.to_h
          }
        end
      end
    end
  end
end