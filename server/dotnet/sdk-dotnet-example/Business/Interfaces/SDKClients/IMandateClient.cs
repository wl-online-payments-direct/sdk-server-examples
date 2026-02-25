using Business.Domain.Payments;
using Business.DTOs.CreatePayments;

namespace Business.Interfaces.SDKClients;

public interface IMandateClient
{
    public Task<Mandate> CreateMandate(CreatePaymentRequestDto mandateRequest);
    
    public Task<MandateResponse?> GetMandate(string? existingUniqueMandateReference);
}