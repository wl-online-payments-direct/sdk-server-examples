using Microsoft.Extensions.DependencyInjection;
using Microsoft.Extensions.Options;
using OnlinePayments.Sdk;
using OnlinePayments.Sdk.Merchant;

namespace Configuration;

public static class DIConfiguration
{
    public static IServiceCollection AddConfiguration(this IServiceCollection services)
    {
        services.AddSingleton<IClient>(sp =>
        {
            AppSettings.AppSettings appSettings = sp.GetRequiredService<IOptions<AppSettings.AppSettings>>().Value;
            CommunicatorConfiguration communicatorConfiguration = new()
            {
                ApiEndpoint = new Uri(appSettings.ApiEndpoint),
                ApiKeyId = appSettings.ApiKey,
                SecretApiKey = appSettings.ApiSecret,
                Integrator = appSettings.MerchantId
            };

            return Factory.CreateClient(communicatorConfiguration);
        });

        services.AddSingleton<MerchantClientConfiguration.MerchantClientConfiguration>();
        services.AddSingleton<IMerchantClient>(sp =>
        {
            MerchantClientConfiguration.MerchantClientConfiguration merchantClientConfiguration =
                sp.GetRequiredService<MerchantClientConfiguration.MerchantClientConfiguration>();

            return merchantClientConfiguration.GetMerchantClient();
        });

        return services;
    }
}