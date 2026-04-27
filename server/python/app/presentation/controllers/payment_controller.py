import logging
from fastapi import APIRouter, Depends
from fastapi import status
from dependency_injector.wiring import inject, Provide
from app.application.interfaces.services.payment_service_interface import PaymentServiceInterface
from app.configuration.di_container.di_container import Container
from app.infrastructure.mappers.additional_payment_actions.cancel_payment_mapper import CancelPaymentMapper
from app.infrastructure.mappers.additional_payment_actions.capture_payment_mapper import CapturePaymentMapper
from app.infrastructure.mappers.additional_payment_actions.refund_payment_mapper import RefundPaymentMapper
from app.presentation.mappers.additional_payment_mapper import AdditionalPaymentActionsPresentationMapper
from app.presentation.mappers.payment_details_mapper import PaymentDetailsPresentationMapper
from app.presentation.mappers.payment_mapper import PaymentPresentationMapper
from app.presentation.models.additional_payment_actions.request import AdditionalPaymentActionsRequest
from app.presentation.models.additional_payment_actions.response import AdditionalPaymentActionsResponse
from app.presentation.models.get_payment_details.response import GetPaymentDetailsResponse
from app.presentation.models.create_payment.request import CreatePaymentRequest
from app.presentation.models.create_payment.response import CreatePaymentResponse
from app.presentation.validators.additional_payment_actions.additional_payment_actions_validator import \
    AdditionalPaymentActionsValidator
from app.presentation.validators.payment.payment_validator import PaymentValidator

router = APIRouter(tags=["Payment"])
logger = logging.getLogger(__name__)


@router.post("/payments", response_model=CreatePaymentResponse, status_code=status.HTTP_201_CREATED)
@inject
def create_payment(
        request: CreatePaymentRequest,
        service: PaymentServiceInterface = Depends(Provide[Container.payment_service])
):
    PaymentValidator().validate(request)

    return PaymentPresentationMapper.from_dto(service.create_payment(PaymentPresentationMapper.to_dto(request)))


@router.post("/payments/{id}/captures", response_model=AdditionalPaymentActionsResponse, status_code=status.HTTP_200_OK)
@inject
def capture_payment(
        id: str,
        request: AdditionalPaymentActionsRequest,
        service: PaymentServiceInterface = Depends(Provide[Container.payment_service])
):
    AdditionalPaymentActionsValidator().validate(request)

    return AdditionalPaymentActionsPresentationMapper.from_dto(
        service.capture_payment(AdditionalPaymentActionsPresentationMapper.to_dto(request, id)))


@router.post("/payments/{id}/refunds", response_model=AdditionalPaymentActionsResponse, status_code=status.HTTP_200_OK)
@inject
def refund_payment(
        id: str,
        request: AdditionalPaymentActionsRequest,
        service: PaymentServiceInterface = Depends(Provide[Container.payment_service])
):
    AdditionalPaymentActionsValidator().validate(request)

    return AdditionalPaymentActionsPresentationMapper.from_dto(
        service.refund_payment(AdditionalPaymentActionsPresentationMapper.to_dto(request, id)))


@router.post("/payments/{id}/cancels", response_model=AdditionalPaymentActionsResponse, status_code=status.HTTP_200_OK)
@inject
def cancel_payment(
        id: str,
        request: AdditionalPaymentActionsRequest,
        service: PaymentServiceInterface = Depends(Provide[Container.payment_service])
):
    AdditionalPaymentActionsValidator().validate(request)

    return AdditionalPaymentActionsPresentationMapper.from_dto(
        service.cancel_payment(AdditionalPaymentActionsPresentationMapper.to_dto(request, id)))


@router.get("/payments/{id}", response_model=GetPaymentDetailsResponse, status_code=status.HTTP_200_OK)
@inject
def get_payment_details(
        id: str,
        service: PaymentServiceInterface = Depends(Provide[Container.payment_service])
):
    response_dto = service.get_payment_details(id)

    return PaymentDetailsPresentationMapper.from_dto(response_dto)
