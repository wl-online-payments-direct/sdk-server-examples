from enum import Enum

class Action(str, Enum):
    PREVIEW = "PREVIEW"
    CREATE = "CREATE"

    @classmethod
    def has_value(cls, value: str) -> bool:
        return value in cls._value2member_map_