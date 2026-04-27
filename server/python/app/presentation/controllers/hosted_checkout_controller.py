from fastapi import APIRouter, Depends
from dependency_injector.wiring import inject, Provide
from fastapi import status
from app.application.interfaces.services.hosted_checkout_service_interface import HostedCheckoutServiceInterface
from app.configuration.di_container.di_container import Container
from app.presentation.mappers.hosted_checkout_mapper import HostedCheckoutPresentationMapper
from app.presentation.models.get_payment_by_hosted_checkout_id.response import HostedCheckoutPaymentResponse
from app.presentation.models.hosted_checkout.request import HostedCheckoutRequest
from app.presentation.validators.hosted_checkout.hosted_checkout_validator import HostedCheckoutValidator

router = APIRouter(tags=["Hosted Checkout"])


@router.post("/sessions", status_code=status.HTTP_201_CREATED)
@inject
def create_hosted_checkout_session(
        request: HostedCheckoutRequest,
        service: HostedCheckoutServiceInterface = Depends(Provide[Container.hosted_checkout_service])
):
    HostedCheckoutValidator().validate(request)

    return HostedCheckoutPresentationMapper.from_dto(
        service.create_hosted_checkout(HostedCheckoutPresentationMapper.to_dto(request)))


@router.get("/sessions/{id}", response_model=HostedCheckoutPaymentResponse, status_code=status.HTTP_200_OK)
@inject
def get_payment_by_hosted_checkout_id(
        id: str,
        service: HostedCheckoutServiceInterface = Depends(Provide[Container.hosted_checkout_service])
):
    return HostedCheckoutPresentationMapper.from_get_payment_dto(service.get_payment_by_hosted_checkout_id(id))
