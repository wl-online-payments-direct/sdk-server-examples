import logging
from onlinepayments.sdk.merchant.i_merchant_client import IMerchantClient
from app.application.domain.payments.mandate import Mandate
from app.infrastructure.mappers.exception_mapper import ExceptionMapper
from app.infrastructure.mappers.mandate_mapper import MandateMapper

logger = logging.getLogger(__name__)


class MandateClient:

    def __init__(self, merchant_client: IMerchantClient):
        self._merchant_client = merchant_client

    def create_mandate(self, request_dto) -> Mandate:
        try:
            logger.info("Creating mandate start.")
            sdk_request = MandateMapper.to_sdk_request(request_dto)
            sdk_response = self._merchant_client.mandates().create_mandate(sdk_request)
            logger.info(
                f"Successful mandate with unique mandate reference: {sdk_response.mandate.unique_mandate_reference}.")

            return MandateMapper.from_sdk_create_response(sdk_response)
        except Exception as ex:
            logger.error(f"Error occurred while creating mandate: {str(ex)}")
            raise ExceptionMapper.map(ex)

    def get_mandate(self, mandate_reference: str):
        if not mandate_reference:
            return None
        try:
            logger.info("Get mandate request.")
            sdk_response = self._merchant_client.mandates().get_mandate(mandate_reference)
            mandate = getattr(sdk_response, 'mandate', None)

            if not getattr(mandate, 'unique_mandate_reference', None):
                return None

            logger.info("Mandate retrieved successfully.")

            return MandateMapper.from_sdk_get_response(sdk_response)
        except Exception as ex:
            logger.error(f"Error occurred while getting mandate: {str(ex)}")
            raise ExceptionMapper.map(ex)
