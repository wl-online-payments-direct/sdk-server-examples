package com.onlinepayments.example.service.domain.common;

import com.onlinepayments.example.service.domain.common.enums.StatusCategory;

public record StatusOutput(
        Integer statusCode,
        StatusCategory statusCategory
) { }
