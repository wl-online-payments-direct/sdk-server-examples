from enum import Enum

class ValidFor(int, Enum):
    ONE_DAY = 24
    TWO_DAYS = 48
    TWO_WEEKS = 336
    ONE_MONTH = 720

    @classmethod
    def has_value(cls, value: int) -> bool:
        return value in cls._value2member_map_