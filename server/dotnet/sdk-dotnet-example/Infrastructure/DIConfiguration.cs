using Business.Interfaces.SDKClients;
using Infrastructure.SDKClients;

namespace Infrastructure;

public static class DIConfiguration
{
    public static IServiceCollection AddInfrastructureLayerDependencies(this IServiceCollection services)
    {
        services.AddTransient<IHostedCheckoutClient, HostedCheckoutClient>();
        services.AddTransient<IPaymentLinkClient, PaymentLinkClient>();
        services.AddTransient<IHostedTokenizationClient, HostedTokenizationClient>();
        services.AddTransient<IPaymentClient, PaymentClient>();
        services.AddTransient<IMandateClient, MandateClient>();
        services.AddTransient<IServiceClient, ServiceClient>();
        
        return services;
    }
}