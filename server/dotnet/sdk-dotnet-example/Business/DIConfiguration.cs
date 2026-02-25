using Business.Handlers;
using Business.Interfaces.Handlers;
using Business.Interfaces.Services;
using Business.Services;
using Microsoft.Extensions.DependencyInjection;

namespace Business;

public static class DIConfiguration
{
    public static IServiceCollection AddBusinessLayerDependencies(this IServiceCollection services)
    { 
        services.AddTransient<IHostedCheckoutService, HostedCheckoutService>();
        services.AddTransient<IPaymentLinkService, PaymentLinkService>();
        services.AddTransient<IHostedTokenizationService, HostedTokenizationService>();
        services.AddTransient<IPaymentService, PaymentService>();
        
        services.AddTransient<IPaymentMethodHandler, TokenPaymentHandler>();
        services.AddTransient<IPaymentMethodHandler, DirectDebitPaymentHandler>();
        services.AddTransient<IPaymentMethodHandler, CreditCardPaymentHandler>();
        
        return services;
    }
}