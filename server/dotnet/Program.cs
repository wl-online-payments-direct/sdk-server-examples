using Microsoft.Extensions.FileProviders;
using OnlinePayments.Sdk.Example;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddControllersWithViews();

builder.Services.Configure<AppSettings>(builder.Configuration.GetSection("AppSettings"));
builder.Services.AddSingleton<MerchantClientConfig>();
builder.Services.AddSingleton<HostedCheckoutMapper>();
builder.Services.AddSingleton<HostedCheckoutService>();
builder.Services.AddSingleton<PaymentDetailsService>();
builder.Services.AddSingleton<HostedTokenizationMapper>();
builder.Services.AddSingleton<HostedTokenizationService>();
builder.Services.AddSingleton<CreatePaymentService>();
builder.Services.AddSingleton<CreatePaymentMapper>();


var app = builder.Build();

// Configure the HTTP request pipeline.
if (!app.Environment.IsDevelopment())
{
    app.UseExceptionHandler("/Home/Error");
    // The default HSTS value is 30 days. You may want to change this for production scenarios, see https://aka.ms/aspnetcore-hsts.
    app.UseHsts();
}

app.UseHttpsRedirection();
app.UseStaticFiles(new StaticFileOptions
    {
        FileProvider = new PhysicalFileProvider(
            Path.Combine(Directory.GetCurrentDirectory(), "../../client")),
        RequestPath = ""
    });

app.UseRouting();

app.UseAuthorization();

app.MapControllerRoute(
    name: "default",
    pattern: "{controller=Home}/{action=Index}/{id?}");

app.Run();
