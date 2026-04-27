module Business
  module Domain
    module Payments
      module PaymentDetails
        class PersonalName
          attr_accessor :first_name, :surname, :title

          def initialize(first_name: nil, surname: nil, title: nil)
            @first_name = first_name
            @surname = surname
            @title = title
          end

          def to_h
            {
              'firstName' => @first_name,
              'surname' => @surname,
              'title' => @title
            }
          end
        end
      end
    end
  end
end