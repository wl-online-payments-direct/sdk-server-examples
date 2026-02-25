using System.Text.Json.Serialization;
using Business;
using FluentValidation;
using FluentValidation.AspNetCore;
using Infrastructure;
using Microsoft.AspNetCore.Mvc;
using Presentation.Extensions;
using Presentation.Validators.AdditionalPaymentActionValidators;
using Presentation.Validators.CreatePaymentsValidators;
using Presentation.Validators.HostedCheckoutValidators;
using Presentation.Validators.PaymentLinkValidators;

namespace Presentation;

public static class DIConfiguration
{
    public static IServiceCollection AddPresentationLayerDependencies(this IServiceCollection services)
    {
        services.AddBusinessLayerDependencies();
        services.AddInfrastructureLayerDependencies();
        services.AddControllers().AddJsonOptions(options =>
        {
            options.JsonSerializerOptions.Converters.Add(new JsonStringEnumConverter());
        });
        
        services.AddEndpointsApiExplorer();
        services.AddSwaggerGen(c =>
        {
            c.CustomSchemaIds(type => type.FullName);
        });

        services.AddFluentValidationAutoValidation();
        services.AddFluentValidationClientsideAdapters();
        services.AddValidatorsFromAssemblyContaining<CreateHostedCheckoutValidator>();
        services.AddValidatorsFromAssemblyContaining<PaymentLinkValidator>();
        services.AddValidatorsFromAssemblyContaining<CreatePaymentValidator>();
        services.AddValidatorsFromAssemblyContaining<AdditionalPaymentActionValidator>();
        
        services.Configure<ApiBehaviorOptions>(options =>
        {
            options.InvalidModelStateResponseFactory = context =>
            {
                string? firstError = context.GetFirstValidationError();

                if (string.IsNullOrWhiteSpace(firstError))
                {
                    firstError = "One or more validation errors occurred.";
                }

                return new BadRequestObjectResult(new { message = firstError });
            };
        });
        
        return services;
    }
}