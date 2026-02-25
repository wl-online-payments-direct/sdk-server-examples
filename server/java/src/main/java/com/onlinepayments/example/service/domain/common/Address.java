package com.onlinepayments.example.service.domain.common;

import com.onlinepayments.example.service.domain.common.enums.Country;

public record Address(String firstName,
                      String lastName,
                      Country country,
                      String zip,
                      String city,
                      String street) {}

