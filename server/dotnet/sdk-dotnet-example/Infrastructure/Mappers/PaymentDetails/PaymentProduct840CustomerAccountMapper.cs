using PaymentProduct840CustomerAccountSdk = OnlinePayments.Sdk.Domain.PaymentProduct840CustomerAccount;
using PaymentProduct840CustomerAccountDto = Business.Domain.Payments.PaymentDetails.PaymentProduct840CustomerAccount;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PaymentProduct840CustomerAccountMapper
{
    public static PaymentProduct840CustomerAccountDto Map(PaymentProduct840CustomerAccountSdk? response)
    {
        return new()
        {
            AccountId = response?.AccountId,
            CompanyName = response?.CompanyName,
            CountryCode = response?.CountryCode,
            FirstName = response?.FirstName,
            CustomerAccountStatus = response?.CustomerAccountStatus,
            CustomerAddressStatus = response?.CustomerAddressStatus,
            PayerId = response?.PayerId,
            Surname = response?.Surname
        };
    }
}