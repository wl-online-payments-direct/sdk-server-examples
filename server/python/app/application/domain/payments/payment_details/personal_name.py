from dataclasses import dataclass
from typing import Optional

@dataclass
class PersonalName:
    first_name: Optional[str] = None
    surname: Optional[str] = None
    title: Optional[str] = None