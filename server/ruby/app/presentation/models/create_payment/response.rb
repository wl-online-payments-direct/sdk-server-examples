module Presentation
  module Models
    module CreatePayment
      class Response
        attr_accessor :id,
                      :status,
                      :status_output

        def initialize(id: nil, status: nil, status_output: nil)
          @id = id
          @status = status
          @status_output = status_output || Business::Domain::Payments::StatusOutput.new
        end

        def self.from_sdk_hash(hash)
          return nil unless hash.is_a?(Hash)

          status_enum = Business::Domain::Enums::Common::Status.try_from(hash['status'])
          status_output_object = Business::Domain::Payments::StatusOutput.from_hash(hash['status_output'])

          new(
            id: hash['id'],
            status: status_enum,
            status_output: status_output_object
          )
        end

        def to_sdk_hash
          {
            'id' => @id,
            'status' => @status&.to_h,
            'statusOutput' => @status_output ? {
              'statusCode' => @status_output.status_code,
              'statusCategory' => @status_output.status_category&.to_h
            } : nil
          }
        end
      end
    end
  end
end