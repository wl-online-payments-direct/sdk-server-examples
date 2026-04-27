from config.logging import setup_logging

setup_logging()

from fastapi import FastAPI
from app.configuration.di_container.di_container import Container
from app.presentation.middleware.global_exception_middleware import register_exception_handlers
from app.presentation.controllers.hosted_checkout_controller import router as hosted_checkout_router
from app.presentation.controllers.payment_link_controller import router as payment_link_router
from app.presentation.controllers.hosted_tokenization_controller import router as hosted_tokenization_router
from app.presentation.controllers.payment_controller import router as payment_router
from app.presentation.middleware.cors_middleware import CustomCORSMiddleware

def create_app() -> FastAPI:
    container = Container()
    container.wire(packages=["app.presentation.controllers"])

    app = FastAPI()
    app.container = container

    app.add_middleware(CustomCORSMiddleware, allowed_origin = container.settings().allowed_origin)
    register_exception_handlers(app)
    app.include_router(hosted_checkout_router)
    app.include_router(payment_link_router)
    app.include_router(hosted_tokenization_router)
    app.include_router(payment_router)

    return app

app = create_app()