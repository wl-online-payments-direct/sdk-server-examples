from dependency_injector import containers, providers
from app.application.handlers.credit_card_payment_handler import CreditCardPaymentHandler
from app.application.handlers.direct_debit_payment_handler import DirectDebitPaymentHandler
from app.application.handlers.token_payment_handler import TokenPaymentHandler
from app.application.services.hosted_tokenization_service import HostedTokenizationService
from app.application.services.payment_link_service import PaymentLinkService
from app.application.services.payment_service import PaymentService
from app.infrastructure.sdk_clients.hosted_tokenization_client import HostedTokenizationClient
from app.infrastructure.sdk_clients.mandate_client import MandateClient
from app.infrastructure.sdk_clients.payment_client import PaymentClient
from app.infrastructure.sdk_clients.payment_link_client import PaymentLinkClient
from app.infrastructure.sdk_clients.service_client import ServiceClient
from config.settings import Settings
from app.configuration.merchant_client_configuration.merchant_client_config import create_merchant_client
from app.application.services.hosted_checkout_service import HostedCheckoutService
from app.infrastructure.sdk_clients.hosted_checkout_client import HostedCheckoutClient

class Container(containers.DeclarativeContainer):

    wiring_config = containers.WiringConfiguration(
        packages=["app.presentation.controllers"]
    )

    settings = providers.Singleton(Settings)

    merchant_client = providers.Singleton(
        create_merchant_client,
        settings=settings
    )

    hosted_checkout_client = providers.Singleton(
        HostedCheckoutClient,
        merchant_client=merchant_client
    )

    hosted_checkout_service = providers.Singleton(
        HostedCheckoutService,
        hosted_checkout_client=hosted_checkout_client
    )

    payment_link_client = providers.Singleton(
        PaymentLinkClient,
        merchant_client=merchant_client
    )

    payment_link_service = providers.Singleton(
        PaymentLinkService,
        payment_link_client=payment_link_client
    )

    hosted_tokenization_client = providers.Singleton(
        HostedTokenizationClient,
        merchant_client=merchant_client
    )

    hosted_tokenization_service = providers.Singleton(
        HostedTokenizationService,
        hosted_tokenization_client=hosted_tokenization_client
    )

    payment_client = providers.Singleton(
        PaymentClient,
        merchant_client=merchant_client
    )

    service_client = providers.Singleton(
        ServiceClient,
        merchant_client=merchant_client
    )

    credit_card_handler = providers.Singleton(
        CreditCardPaymentHandler,
        payment_client=payment_client,
        service_client=service_client
    )

    token_handler = providers.Singleton(
        TokenPaymentHandler,
        payment_client=payment_client
    )

    mandate_client = providers.Singleton(
        MandateClient,
        merchant_client=merchant_client
    )

    direct_debit_handler = providers.Singleton(
        DirectDebitPaymentHandler,
        payment_client=payment_client,
        mandate_client=mandate_client
    )

    payment_service = providers.Singleton(
        PaymentService,
        payment_client=payment_client,
        handlers=providers.List(
            credit_card_handler,
            token_handler,
            direct_debit_handler
        )
    )