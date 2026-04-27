from enum import Enum

class Status(str, Enum):
    ACTIVE = "ACTIVE"
    INACTIVE = "INACTIVE"
    EXPIRED = "EXPIRED"

    @classmethod
    def try_from(cls, value: str):
        try:
            return cls(value.upper())
        except ValueError:
            return None