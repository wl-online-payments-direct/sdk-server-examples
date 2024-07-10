require 'active_support/core_ext/string'
require 'active_support/core_ext/hash'

class PaymentUtils
  def self.to_amount(amount)
    converted_amount = BigDecimal(amount)
    (converted_amount * BigDecimal('100')).round(0, BigDecimal::ROUND_HALF_UP).to_i
  end

  def self.to_camel_case_keys(hash)
    hash.deep_transform_keys! { |key| key.to_s.camelize(:lower) }
  end
end
