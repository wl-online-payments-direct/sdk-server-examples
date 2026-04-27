module Business
  module Domain
    module Payments
      module PaymentDetails
        class ThreeDSecureResults
          attr_accessor :acs_transaction_id, :applied_exemption, :authentication_status,
                        :cavv, :challenge_indicator, :ds_transaction_id, :eci,
                        :exemption_engine_flow, :flow, :liability, :scheme_eci,
                        :version, :xid

          def initialize(
            acs_transaction_id: nil, applied_exemption: nil, authentication_status: nil,
            cavv: nil, challenge_indicator: nil, ds_transaction_id: nil, eci: nil,
            exemption_engine_flow: nil, flow: nil, liability: nil, scheme_eci: nil,
            version: nil, xid: nil
          )
            @acs_transaction_id = acs_transaction_id
            @applied_exemption = applied_exemption
            @authentication_status = authentication_status
            @cavv = cavv
            @challenge_indicator = challenge_indicator
            @ds_transaction_id = ds_transaction_id
            @eci = eci
            @exemption_engine_flow = exemption_engine_flow
            @flow = flow
            @liability = liability
            @scheme_eci = scheme_eci
            @version = version
            @xid = xid
          end

          def to_h
            {
              'acsTransactionId' => @acs_transaction_id,
              'appliedExemption' => @applied_exemption,
              'authenticationStatus' => @authentication_status,
              'cavv' => @cavv,
              'challengeIndicator' => @challenge_indicator,
              'dsTransactionId' => @ds_transaction_id,
              'eci' => @eci,
              'exemptionEngineFlow' => @exemption_engine_flow,
              'flow' => @flow,
              'liability' => @liability,
              'schemeEci' => @scheme_eci,
              'version' => @version,
              'xid' => @xid
            }
          end
        end
      end
    end
  end
end