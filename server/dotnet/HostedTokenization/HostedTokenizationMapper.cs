using Microsoft.Extensions.Options;
using OnlinePayments.Sdk.Domain;

namespace OnlinePayments.Sdk.Example;

public class HostedTokenizationMapper
{
    private readonly AppSettings _appSettings;

    public HostedTokenizationMapper(IOptions<AppSettings> appSettings)
    {
        _appSettings = appSettings.Value;
    }

    /// <summary>
    /// Converts CreateHostedTokenizationBasicDto to CreatePaymentRequest
    /// </summary>
    /// <param name="CreateHostedTokenizationBasicDto">Create hosted tokenization dto to be converted</param>
    /// <returns>Converted instance of CreatePaymentRequest</returns>
    public CreatePaymentRequest ToHostedTokenizationPaymentRequest(CreateHostedTokenizationBasicDto createHostedTokenizationBasicDto) {
        return new CreatePaymentRequest(){
            Order = new Order() {
                AmountOfMoney = new AmountOfMoney() {
                    Amount = ToAmount(createHostedTokenizationBasicDto.Amount),
                    CurrencyCode = createHostedTokenizationBasicDto.Currency
                },
                Customer = new Customer() {
                    Device = new CustomerDevice() {
                        AcceptHeader = "texthtml,application/xhtml+xml,application/xml;q=0.9,/;q=0.8",
                        BrowserData = new BrowserData() {
                            ColorDepth = 24,
                            JavaEnabled = false,
                            ScreenHeight = "1200",
                            ScreenWidth = "1920"
                        },
                        IpAddress = "123.123.123.123",
                        Locale = "en_GB",
                        UserAgent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Safari/605.1.15",
                        TimezoneOffsetUtcMinutes = "420"
                    }
                }
            },
            HostedTokenizationId = createHostedTokenizationBasicDto.HostedTokenizationId,
            CardPaymentMethodSpecificInput = new CardPaymentMethodSpecificInput() {
                AuthorizationMode = "SALE"
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
