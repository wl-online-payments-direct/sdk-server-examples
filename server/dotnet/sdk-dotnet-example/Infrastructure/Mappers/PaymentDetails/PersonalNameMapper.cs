using PersonalNameSdk = OnlinePayments.Sdk.Domain.PersonalName;
using PersonalNameDto = Business.Domain.Payments.PaymentDetails.PersonalName;

namespace Infrastructure.Mappers.PaymentDetails;

public static class PersonalNameMapper
{
    public static PersonalNameDto Map(PersonalNameSdk? response)
    {
        return new()
        {
            Surname = response?.Surname,
            FirstName = response?.FirstName,
            Title = response?.Title
        };
    }
}