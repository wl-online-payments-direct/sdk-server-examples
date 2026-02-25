using CustomerBankAccountSdk = OnlinePayments.Sdk.Domain.CustomerBankAccount;
using CustomerBankAccountDto = Business.Domain.Payments.PaymentDetails.CustomerBankAccount;

namespace Infrastructure.Mappers.PaymentDetails;

public static class CustomerBankAccountMapper
{
    public static CustomerBankAccountDto Map(CustomerBankAccountSdk? response)
    {
        return new()
        {
            AccountHolderName = response?.AccountHolderName,
            Bic = response?.Bic,
            Iban = response?.Iban
        };
    }
}