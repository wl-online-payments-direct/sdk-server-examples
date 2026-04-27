class SdkException(Exception):
    def __init__(self, message: str, status_code: int = 500, cause: Exception = None):
        super().__init__(message)
        self.status_code = status_code
        self.cause = cause