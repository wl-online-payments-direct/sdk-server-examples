from enum import Enum

class Language(str, Enum):
    English = "English"
    French = "French"
    German = "German"

    @classmethod
    def has_value(cls, value: str) -> bool:
        return value in cls._value2member_map_

    def to_locale(self) -> str:
        locale_map = {
            Language.English: "en",
            Language.French: "fr",
            Language.German: "de",
        }
        return locale_map[self]