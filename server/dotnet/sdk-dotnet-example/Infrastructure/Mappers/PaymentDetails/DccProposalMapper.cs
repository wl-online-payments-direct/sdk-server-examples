using DccProposalSdk = OnlinePayments.Sdk.Domain.DccProposal;
using DccProposalDto = Business.Domain.Payments.PaymentDetails.DccProposal;

namespace Infrastructure.Mappers.PaymentDetails;

public static class DccProposalMapper
{
    public static DccProposalDto Map(DccProposalSdk? response)
    {
        return new()
        {
            Rate = RateDetailsMapper.Map(response?.Rate),
            BaseAmount = AmountOfMoneyMapper.Map(response?.BaseAmount),
            DisclaimerDisplay = response?.DisclaimerDisplay,
            DisclaimerReceipt = response?.DisclaimerReceipt,
            TargetAmount = AmountOfMoneyMapper.Map(response?.TargetAmount)
        };
    }
}