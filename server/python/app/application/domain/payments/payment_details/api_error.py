from dataclasses import dataclass
from typing import Optional

@dataclass
class APIError:
    category: Optional[str] = None
    code: Optional[str] = None
    error_code: Optional[str] = None
    http_status_code: Optional[int] = None
    id: Optional[str] = None
    message: Optional[str] = None
    property_name: Optional[str] = None
    retriable: Optional[bool] = None