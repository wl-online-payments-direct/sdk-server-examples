using Business.DTOs.CreateHostedCheckouts;
using Business.DTOs.GetPaymentByHostedCheckoutId;
using Infrastructure.Extensions.Models;
using OnlinePayments.Sdk.Domain;

namespace Infrastructure.Mappers;

public static class HostedCheckoutMapper
{
    public static CreateHostedCheckoutRequest Map(CreateHostedCheckoutRequestDto requestDto)
    {
        return new()
        {
            Order = new()
            {
                AmountOfMoney = new()
                {
                    Amount = (long?)requestDto.Amount,
                    CurrencyCode = requestDto.Currency.ToString()
                },
                Customer = new()
                {
                    PersonalInformation = new()
                    {
                        Name = new()
                        {
                            FirstName = requestDto.BillingAddress?.FirstName,
                            Surname = requestDto.BillingAddress?.LastName
                        }
                    },
                    BillingAddress = new()
                    {
                        City = requestDto.BillingAddress?.City,
                        CountryCode = requestDto.BillingAddress?.Country.ToIsoAlpha2(),
                        Street = requestDto.BillingAddress?.Street,
                        Zip = requestDto.BillingAddress?.Zip
                    }
                },
                Shipping = new()
                {
                    Address = new()
                    {
                        City = requestDto.ShippingAddress?.City,
                        CountryCode = requestDto.ShippingAddress?.Country.ToIsoAlpha2(),
                        Street = requestDto.ShippingAddress?.Street,
                        Zip = requestDto.ShippingAddress?.Zip,
                        Name = new()
                        {
                            FirstName = requestDto.ShippingAddress?.FirstName,
                            Surname = requestDto.ShippingAddress?.LastName
                        }
                    }
                }
            },
            HostedCheckoutSpecificInput = new()
            {
                ReturnUrl = requestDto.RedirectUrl,
                Locale = requestDto.Language.ToLocale(requestDto.BillingAddress?.Country)
            }
        };
    }

    public static CreateHostedCheckoutResponseDto Map(CreateHostedCheckoutResponse? response)
    {
        return new()
        {
            HostedCheckoutId = response?.HostedCheckoutId,
            RedirectUrl = response?.RedirectUrl,
            ReturnMAC = response?.RETURNMAC
        };
    }
    
    public static GetPaymentByHostedCheckoutIdResponseDto Map(GetHostedCheckoutResponse? response)
    {
        return new()
        {
            Status = response?.Status,
            PaymentId = response?.CreatedPaymentOutput?.Payment?.Id
        };
    }
}