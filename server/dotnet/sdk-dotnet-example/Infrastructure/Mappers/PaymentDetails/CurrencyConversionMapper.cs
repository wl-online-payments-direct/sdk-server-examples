using CurrencyConversionSdk = OnlinePayments.Sdk.Domain.CurrencyConversion;
using CurrencyConversionDto = Business.Domain.Payments.PaymentDetails.CurrencyConversion;

namespace Infrastructure.Mappers.PaymentDetails;

public static class CurrencyConversionMapper
{
    public static CurrencyConversionDto Map(CurrencyConversionSdk? response)
    {
        return new()
        {
            AcceptedByUser = response?.AcceptedByUser,
            Proposal = DccProposalMapper.Map(response?.Proposal)
        };
    }
}