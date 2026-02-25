package com.onlinepayments.example.api.validators;

import java.net.MalformedURLException;
import java.net.URL;

public abstract class BaseValidator{
    public static boolean isNullOrEmpty(String value) {
        return value == null || value.trim().isEmpty();
    }

    public static boolean isValidUrl(String url) {
        try {
            new URL(url);
            return true;
        } catch (MalformedURLException e) {
            return false;
        }
    }
}
