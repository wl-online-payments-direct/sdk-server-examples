class ValidationException(Exception):
    def __init__(self, errors: list[str]):
        super().__init__(errors[0] if errors else "Validation error occurred.")
        self.errors = errors