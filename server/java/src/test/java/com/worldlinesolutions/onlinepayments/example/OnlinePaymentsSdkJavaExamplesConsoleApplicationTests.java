package com.worldlinesolutions.onlinepayments.example;

import com.worldlinesolutions.onlinepayments.example.payment.CreatePaymentService;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;

import static org.junit.jupiter.api.Assertions.assertNotNull;

@SpringBootTest
class OnlinePaymentsSdkJavaExamplesConsoleApplicationTests {

    @Autowired
    private CreatePaymentService createPaymentService;

    @Test
    void contextLoads() {
        assertNotNull(createPaymentService);
    }

}
