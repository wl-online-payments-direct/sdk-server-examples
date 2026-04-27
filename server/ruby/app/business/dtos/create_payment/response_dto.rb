module Business
  module Dtos
    module CreatePayment
      class ResponseDto
        attr_accessor :id,
                      :status,
                      :status_output

        def initialize(id: nil, status: nil, status_output: nil)
          @id = id
          @status = status
          @status_output = status_output
        end

        def self.from_hash(hash)
          return nil unless hash.is_a?(Hash)

          status_enum = hash['status'] ? Business::Domain::Enums::Common::Status.try_from(hash['status']) : nil

          status_output_obj = hash['status_output'] ? Business::Domain::Payments::StatusOutput.from_hash(hash['status_output']) : nil

          new(
            id: hash['id'],
            status: status_enum,
            status_output: status_output_obj
          )
        end

        def to_h
          {
            'id' => @id,
            'status' => @status&.to_h,
            'status_output' => @status_output&.to_h
          }
        end
      end
    end
  end
end