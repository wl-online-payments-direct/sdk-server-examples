using Business.Domain.Payments;
using Business.DTOs.CreatePayments;
using Infrastructure.Extensions.Models;
using OnlinePayments.Sdk.Domain;
using MandateResponse = Business.Domain.Payments.MandateResponse;

namespace Infrastructure.Mappers;

public static class MandateMapper
{
    public static CreateMandateRequest Map(CreatePaymentRequestDto? requestDto)
    {
        return new()
        {
            Customer = new()
            {
                BankAccountIban = new()
                {
                    Iban = requestDto?.Mandate?.IBAN
                },
                MandateAddress = new()
                {
                    CountryCode = requestDto?.Mandate?.Address?.Country.ToIsoAlpha2(),
                    City = requestDto?.Mandate?.Address?.City,
                    Street = requestDto?.Mandate?.Address?.Street,
                    Zip = requestDto?.Mandate?.Address?.Zip
                },
                PersonalInformation = new()
                {
                    Name = new()
                    {
                        FirstName = requestDto?.Mandate?.Address?.FirstName,
                        Surname = requestDto?.Mandate?.Address?.LastName
                    }
                }
            },
            CustomerReference = requestDto?.Mandate?.CustomerReference,
            RecurrenceType = requestDto?.Mandate?.RecurrenceType.ToString(),
            ReturnUrl = requestDto?.Mandate?.ReturnUrl,
            SignatureType = requestDto?.Mandate?.SignatureType.ToString()
        };
    }

    public static MandateResponse? Map(GetMandateResponse? getMandateResponse)
    {
        if (getMandateResponse?.Mandate == null)
        {
            return null;
        }
        
        return new()
        {
            UniqueMandateReference = getMandateResponse.Mandate.UniqueMandateReference
        };
    }
    
    public static Mandate Map(CreateMandateResponse createMandateResponse)
    {
        return new()
        {
            IBAN = createMandateResponse.Mandate.Customer.BankAccountIban.Iban,
            CustomerReference = createMandateResponse.Mandate.CustomerReference,
            ReturnUrl = createMandateResponse.MerchantAction.RedirectData.RedirectURL
        };
    }
}