require 'dry/validation'
require 'date'

module Presentation
  module Validators
    module Common
      module Card
        class CardContract < Dry::Validation::Contract
          attr_reader :prefix

          def initialize(prefix: 'Card')
            @prefix = prefix
            super()
          end

          params do
            optional(:number)
            optional(:holder_name)
            optional(:verification_code)
            optional(:expiry_month)
            optional(:expiry_year)
          end

          rule(:number) do
            if value.nil? || value.to_s.strip.empty?
              key.failure("The #{prefix}.Number field is required.")
              next
            end

            number_str = value.to_s.strip

            unless number_str.match?(/\A\d+\z/)
              key.failure("The #{prefix}.Number field must be a valid number.")
              next
            end

            if number_str.length > 19
              key.failure("The #{prefix}.Number field must be shorter than 20 characters.")
            end
          end

          rule(:holder_name) do
            if value.nil? || value.to_s.strip.empty?
              key.failure("The #{prefix}.HolderName field is required.")
            end
          end

          rule(:verification_code) do
            if value.nil? || value.to_s.strip.empty?
              key.failure("The #{prefix}.VerificationCode field is required.")
              next
            end

            cvv_str = value.to_s.strip
            len = cvv_str.length

            if len < 3 || len > 4 || !cvv_str.match?(/\A\d+\z/)
              key.failure("The #{prefix}.VerificationCode field must be 3 or 4 digits long.")
            end
          end

          rule(:expiry_month) do
            if value.nil? || value.to_s.strip.empty?
              key.failure("The #{prefix}.ExpiryMonth field is required.")
              next
            end

            month_str = value.to_s.strip

            unless month_str.match?(/\A\d+\z/)
              key.failure("The #{prefix}.ExpiryMonth field must be a number.")
              next
            end

            unless month_str.length == 2
              key.failure("The #{prefix}.ExpiryMonth field must be 2 digits long.")
              next
            end

            month = month_str.to_i
            unless month >= 1 && month <= 12
              key.failure("The #{prefix}.ExpiryMonth field must be a number between 01 and 12.")
            end
          end

          rule(:expiry_year) do
            if value.nil? || value.to_s.strip.empty?
              key.failure("The #{prefix}.ExpiryYear field is required.")
              next
            end

            year_str = value.to_s.strip

            unless year_str.match?(/\A\d+\z/)
              key.failure("The #{prefix}.ExpiryYear field must be a number.")
              next
            end

            unless year_str.length == 4
              key.failure("The #{prefix}.ExpiryYear field must be 4 digits long.")
            end
          end

          rule(:expiry_month, :expiry_year) do
            month_str = values[:expiry_month].to_s.strip
            year_str = values[:expiry_year].to_s.strip

            next if month_str.empty? || year_str.empty?

            next unless month_str.match?(/\A\d+\z/) && year_str.match?(/\A\d+\z/)

            next unless month_str.length == 2 && year_str.length == 4

            m = month_str.to_i
            next unless m >= 1 && m <= 12

            begin
              unless has_future_expiry_date?(month_str, year_str)
                key(:expiry_year).failure("The card expiry date must be in the future.")
              end
            rescue StandardError => e
              key(:expiry_year).failure(e.message)
            end
          end

          private

          def has_future_expiry_date?(month, year)
            m = month.to_i
            y = year.to_i

            return false unless (1..12).include?(m) && y > 0

            expiry = Date.new(y, m, -1)
            expiry > Date.today
          end
        end
      end
    end
  end
end