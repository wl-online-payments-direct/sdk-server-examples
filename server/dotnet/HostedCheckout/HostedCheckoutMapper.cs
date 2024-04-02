using Microsoft.Extensions.Options;
using OnlinePayments.Sdk.Domain;

namespace OnlinePayments.Sdk.Example;

/// <summary>
/// Mapper component used for conversion from Dtos to SDK Domain classes and vice-a-versa
/// </summary>
public class HostedCheckoutMapper
{
    private readonly AppSettings _appSettings;

    public HostedCheckoutMapper(IOptions<AppSettings> appSettings)
    {
        _appSettings = appSettings.Value;
    }

    /// <summary>
    /// Creates an empty CreateHostedCheckoutBasicDto
    /// </summary>
    /// <returns>Instance of CreateHostedCheckoutBasicDto</returns>
    public CreateHostedCheckoutBasicDto ToEmptyDto() {
        return new CreateHostedCheckoutBasicDto() {
            RedirectUrl = _appSettings.HostedCheckoutRedirectUrl
        };
    }

    /// <summary>
    /// Converts CreateHostedCheckoutBasicDto to CreateHostedCheckoutRequest
    /// </summary>
    /// <param name="createHostedCheckoutBasicDto">Create hosted checkout dto to be converted</param>
    /// <returns>Converted instance of CreateHostedCheckoutRequest</returns>
    public CreateHostedCheckoutRequest ToCreateHostedCheckoutRequest(CreateHostedCheckoutBasicDto createHostedCheckoutBasicDto) {
        return new CreateHostedCheckoutRequest(){
            Order = new Order() {
                AmountOfMoney = new AmountOfMoney() {
                    Amount = ToAmount(createHostedCheckoutBasicDto.Amount),
                    CurrencyCode = createHostedCheckoutBasicDto.Currency
                }
            },
            HostedCheckoutSpecificInput = new HostedCheckoutSpecificInput() {
                ReturnUrl = createHostedCheckoutBasicDto.RedirectUrl
            }
        };
    }

    private long ToAmount(decimal amount)
    {
        decimal multipliedAmount = decimal.Multiply(amount, new decimal(100));
        decimal roundedAmount = decimal.Round(multipliedAmount, 0, MidpointRounding.ToEven);
        return (long)roundedAmount;
    }
}
