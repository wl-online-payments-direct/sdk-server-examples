using Business.Domain.Common.Enums;
using Business.Domain.Enums.PaymentLinks;
using Business.DTOs.CreatePaymentLinks;
using OnlinePayments.Sdk.Domain;

namespace Infrastructure.Mappers;

public static class PaymentLinkMapper
{
    public static CreatePaymentLinkRequest Map(CreatePaymentLinkRequestDto requestDto)
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
                References = new()
                {
                    MerchantReference = Guid.NewGuid().ToString()
                }
            },
            PaymentLinkSpecificInput = new()
            {
                ExpirationDate = DateTimeOffset.UtcNow.AddHours((int)requestDto.ValidFor),
                Description = requestDto.Description
            }
        };
    }

    public static CreatePaymentLinkResponseDto Map(PaymentLinkResponse? response)
    {
        Enum.TryParse(response?.PaymentLinkOrder?.Amount?.CurrencyCode.ToUpper(), out Currency currency);
        Enum.TryParse(response?.Status.ToUpper(), out Status status);

        return new()
        {
            RedirectUrl = response?.RedirectionUrl,
            PaymentLinkId = response?.PaymentLinkId,
            Status = status,
            Amount = response?.PaymentLinkOrder?.Amount?.Amount,
            Currency = currency
        };
    }
}