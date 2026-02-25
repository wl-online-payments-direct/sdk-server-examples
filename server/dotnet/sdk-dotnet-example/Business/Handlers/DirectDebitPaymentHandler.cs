using Business.Domain.Enums.Payments;
using Business.Domain.Payments;
using Business.DTOs.CreatePayments;
using Business.Interfaces.Handlers;
using Business.Interfaces.SDKClients;

namespace Business.Handlers;

public class DirectDebitPaymentHandler(IPaymentClient paymentClient, IMandateClient mandateClient)
    : IPaymentMethodHandler
{
    private const int DirectDebitProductId = 771;

    public PaymentMethodType SupportedMethod => PaymentMethodType.DIRECT_DEBIT;

    public async Task<CreatePaymentResponseDto> HandleAsync(CreatePaymentRequestDto request)
    {
        MandateResponse? existingMandate = null;

        if (!string.IsNullOrEmpty(request.Mandate?.MandateReference))
        {
            existingMandate = await mandateClient.GetMandate(request.Mandate.MandateReference);
        }

        if (existingMandate == null)
        {
            Mandate newMandate = await mandateClient.CreateMandate(request);

            request.Mandate = newMandate;
        }
        else if (request.Mandate != null)
        {
            request.Mandate.MandateReference = existingMandate.UniqueMandateReference;
        }

        request.PaymentProductId = DirectDebitProductId;

        return await paymentClient.CreatePaymentAsync(request);
    }
}