from fastapi import APIRouter, Depends
from fastapi import status
from dependency_injector.wiring import inject, Provide
from app.application.interfaces.services.hosted_tokenization_service_interface import HostedTokenizationServiceInterface
from app.configuration.di_container.di_container import Container
from app.presentation.mappers.hosted_tokenization_mapper import HostedTokenizationPresentationMapper
from app.presentation.models.hosted_tokenization.response import HostedTokenizationResponse

router = APIRouter(tags=["Hosted Tokenization"])

@router.get("/tokens", response_model=HostedTokenizationResponse, status_code=status.HTTP_200_OK)
@inject
def get_hosted_tokenization_sessions(
        service: HostedTokenizationServiceInterface = Depends(Provide[Container.hosted_tokenization_service])
):
    return HostedTokenizationPresentationMapper.from_dto(service.init_hosted_tokenization())