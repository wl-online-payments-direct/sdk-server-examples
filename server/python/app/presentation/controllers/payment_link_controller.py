from fastapi import APIRouter, Depends
from dependency_injector.wiring import inject, Provide
from fastapi import status
from app.application.interfaces.services.payment_link_service_interface import PaymentLinkServiceInterface
from app.configuration.di_container.di_container import Container
from app.presentation.mappers.payment_link_mapper import PaymentLinkPresentationMapper
from app.presentation.models.payment_link.request import PaymentLinkRequest
from app.presentation.models.payment_link.response import PaymentLinkResponse
from app.presentation.validators.payment_link.payment_link_validator import PaymentLinkValidator

router = APIRouter(tags=["Payment Link"])


@router.post("/links", response_model=PaymentLinkResponse, status_code=status.HTTP_201_CREATED)
@inject
def create_payment_link(
        request: PaymentLinkRequest,
        service: PaymentLinkServiceInterface = Depends(Provide[Container.payment_link_service])
):
    PaymentLinkValidator().validate(request)

    return PaymentLinkPresentationMapper.from_dto(
        service.create_payment_link(PaymentLinkPresentationMapper.to_dto(request)))
