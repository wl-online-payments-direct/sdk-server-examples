using OperationOutputDto = Business.Domain.Payments.PaymentDetails.OperationOutput;
using OperationOutputSdk = OnlinePayments.Sdk.Domain.OperationOutput;

namespace Infrastructure.Mappers.PaymentDetails;

public static class OperationOutputMapper
{
    public static OperationOutputDto Map(OperationOutputSdk? response)
    {
        return new()
        {
            Id = response?.Id,
            OperationReferences = OperationPaymentReferencesMapper.Map(response?.OperationReferences),
            PaymentMethod = response?.PaymentMethod,
            StatusOutput = PaymentStatusOutputMapper.Map(response?.StatusOutput),
            AmountOfMoney = AmountOfMoneyMapper.Map(response?.AmountOfMoney),
            References = PaymentReferencesMapper.Map(response?.References),
            Status = response?.Status,
        };
    }
}