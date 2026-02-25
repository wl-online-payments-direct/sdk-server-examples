<?php

namespace OnlinePayments\ExampleApp\Configuration;

use DI\ContainerBuilder;
use DI;
use OnlinePayments\ExampleApp\Configuration\MerchantClientConfiguration\MerchantClientConfiguration;
use OnlinePayments\Sdk\Merchant\MerchantClient;

class DIConfiguration
{
    private MerchantClientConfiguration $merchantConfig;

    public function __construct(string $projectRoot)
    {
        $this->merchantConfig = new MerchantClientConfiguration($projectRoot);
    }

    public function configure(ContainerBuilder $builder): void
    {
        $builder->addDefinitions([
            MerchantClientConfiguration::class => DI\value($this->merchantConfig),

            MerchantClient::class => function() {
                return $this->merchantConfig->getMerchantClient();
            }
        ]);
    }
}
