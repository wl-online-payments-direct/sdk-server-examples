using Business.Domain.Common.Enums;
using Business.Domain.Enums.Payments;
using Business.DTOs.CreatePayments;
using Infrastructure.Extensions.Models;
using OnlinePayments.Sdk.Domain;

namespace Infrastructure.Mappers;

public static class PaymentMapper
{
    public static CreatePaymentRequest Map(CreatePaymentRequestDto requestDto)
    {
        CreatePaymentRequest request = new()
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
                        Name = new()
                        {
                            FirstName = requestDto.ShippingAddress?.FirstName,
                            Surname = requestDto.ShippingAddress?.LastName
                        },
                        City = requestDto.ShippingAddress?.City,
                        CountryCode = requestDto.ShippingAddress?.Country.ToIsoAlpha2(),
                        Street = requestDto.ShippingAddress?.Street,
                        Zip = requestDto.ShippingAddress?.Zip
                    }
                }
            }
        };

        switch (requestDto.Method)
        {
            case PaymentMethodType.CREDIT_CARD:
                request.CardPaymentMethodSpecificInput = new()
                {
                    PaymentProductId = requestDto.PaymentProductId,
                    Card = new()
                    {
                        CardNumber = requestDto.Card?.Number,
                        CardholderName = requestDto.Card?.HolderName,
                        ExpiryDate = $"{requestDto.Card?.ExpiryMonth}{requestDto.Card?.ExpiryYear.GetYearSuffix()}",
                        Cvv = requestDto.Card?.VerificationCode
                    },
                    ThreeDSecure = new()
                    {
                        SkipAuthentication = true
                    }
                };
                break;

            case PaymentMethodType.TOKEN:
                request.HostedTokenizationId = requestDto.HostedTokenizationId;
                request.CardPaymentMethodSpecificInput = new()
                {
                    ThreeDSecure = new()
                    {
                        SkipAuthentication = true
                    }
                };

                break;

            case PaymentMethodType.DIRECT_DEBIT:
                request.SepaDirectDebitPaymentMethodSpecificInput = new()
                {
                    PaymentProductId = requestDto.PaymentProductId,
                    PaymentProduct771SpecificInput = new()
                    {
                        ExistingUniqueMandateReference = requestDto.Mandate?.MandateReference
                    }
                };
                break;
        }

        return request;
    }

    public static CreatePaymentResponseDto Map(CreatePaymentResponse? response)
    {
        Enum.TryParse(response?.Payment.Status.ToUpper(), out Status status);
        Enum.TryParse(response?.Payment?.StatusOutput?.StatusCategory.ToUpper(), out StatusCategory statusCategory);

        return new()
        {
            Id = response?.Payment?.Id,
            Status = status,
            StatusOutput = new()
            {
                StatusCode = response?.Payment?.StatusOutput?.StatusCode,
                StatusCategory = statusCategory
            }
        };
    }
}