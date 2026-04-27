module Infrastructure
  module Mappers
    module PaymentDetails
      class ThreeDSecureResultsMapper
        def self.from_sdk_response(response)
          return nil if response.nil?

          Business::Domain::Payments::PaymentDetails::ThreeDSecureResults.new(
            acs_transaction_id: response.acs_transaction_id,
            applied_exemption: response.applied_exemption,
            authentication_status: response.authentication_status,
            cavv: response.cavv,
            challenge_indicator: response.challenge_indicator,
            ds_transaction_id: response.ds_transaction_id,
            eci: response.eci,
            exemption_engine_flow: response.exemption_engine_flow,
            flow: response.flow,
            liability: response.liability,
            scheme_eci: response.scheme_eci,
            version: response.version,
            xid: response.xid
          )
        end
      end
    end
  end
end
