using Business.DTOs.Services;
using OnlinePayments.Sdk.Domain;

namespace Infrastructure.Mappers;

public class ServiceMapper
{
    public static GetIINDetailsRequest Map(GetIinDetailsRequestDto request)
    {
        return new()
        {
            Bin = request.Bin
        };
    }
    
    public static GetIinDetailsResponseDto Map(GetIINDetailsResponse response)
    {
        return new()
        {
            PaymentProductId = response.PaymentProductId
        };
    }
}