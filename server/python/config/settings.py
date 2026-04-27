from pydantic_settings import BaseSettings

class Settings(BaseSettings):
    merchant_id: str
    api_key_id: str
    api_secret_key: str
    api_endpoint: str
    integrator: str
    allowed_origin: str

    class Config:
        env_file = ".env"