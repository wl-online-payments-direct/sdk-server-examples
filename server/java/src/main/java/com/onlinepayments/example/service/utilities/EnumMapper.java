package com.onlinepayments.example.service.utilities;

import com.onlinepayments.example.service.domain.common.enums.Country;
import com.onlinepayments.example.service.domain.common.enums.Language;
import org.springframework.stereotype.Component;

@Component
public class EnumMapper {
    public String map(Language language) {
        return language != null ? language.getSdkValue() : null;
    }

    public String map(Country country) {
        return country != null ? country.getSdkValue() : null;
    }
}
