using Configuration;
using Configuration.AppSettings;
using Presentation;
using Presentation.Middleware;
using System.Diagnostics;
using Microsoft.AspNetCore.Hosting.Server;
using Microsoft.AspNetCore.Hosting.Server.Features;

WebApplicationBuilder builder = WebApplication.CreateBuilder(args);

builder.Services
    .AddOptions<AppSettings>()
    .Bind(builder.Configuration.GetSection("AppSettings"))
    .ValidateDataAnnotations()
    .ValidateOnStart();

builder.Services.AddConfiguration();
builder.Services.AddPresentationLayerDependencies();

builder.Services.AddControllers();
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

string? allowedOrigin = Environment.GetEnvironmentVariable("CORS_ALLOWED_ORIGIN");

if (string.IsNullOrEmpty(allowedOrigin))
{
    throw new InvalidOperationException("CORS AllowedOrigins is not configured.");
}

const string allowFrontend = "AllowFrontend";
builder.Services.AddCors(options =>
{
    options.AddPolicy(allowFrontend, p =>
        p.WithOrigins(allowedOrigin) 
            .AllowAnyHeader()
            .AllowAnyMethod()
            .AllowCredentials());
});

WebApplication app = builder.Build();

if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
    
    app.Lifetime.ApplicationStarted.Register(() =>
    {
        IServerAddressesFeature addressesFeature =
            app.Services.GetRequiredService<IServer>().Features.Get<IServerAddressesFeature>()!;

        string baseUrl = addressesFeature.Addresses.First(a => a.StartsWith("http://"));
        Process.Start(new ProcessStartInfo
        {
            FileName = $"{baseUrl}/swagger",
            UseShellExecute = true
        });
    });
}

app.UseCors(allowFrontend);

app.UseMiddleware<GlobalExceptionMiddleware>();

app.MapControllers();

app.Run();