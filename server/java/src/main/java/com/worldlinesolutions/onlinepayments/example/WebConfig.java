package com.worldlinesolutions.onlinepayments.example;

import org.springframework.context.annotation.Configuration;
import org.springframework.web.servlet.config.annotation.ResourceHandlerRegistry;
import org.springframework.web.servlet.config.annotation.ViewControllerRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;

import java.io.File;

@Configuration
public class WebConfig implements WebMvcConfigurer {

    private static final String CLIENT_PATH = "client";

    @Override
    public void addViewControllers(ViewControllerRegistry registry) {
        registry.addViewController("/").setViewName("forward:/index.html");
    }

    @Override
    public void addResourceHandlers(ResourceHandlerRegistry registry) {
        String absolutePath = String.format(new File(CLIENT_PATH).getAbsolutePath(), "/");

        registry.addResourceHandler("/", "/**")
                .addResourceLocations("file:" + absolutePath + "/")
                .setCachePeriod(0);
    }

}
