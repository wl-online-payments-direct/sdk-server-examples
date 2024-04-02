using Microsoft.Extensions.Options;
using OnlinePayments.Sdk.Domain;

namespace OnlinePayments.Sdk.Example;

public class CreatePaymentMapper
{
    private readonly AppSettings _appSettings;

    public CreatePaymentMapper(IOptions<AppSettings> appSettings)
    {
        _appSettings = appSettings.Value;
    }

    /// <summary>
    /// Creates an empty create payment basic dto
    /// </summary>
    /// <returns>Instance of CreatePaymentBasicDto</returns>
    public CreatePaymentBasicDto ToEmptyBasicDto() {
        return new CreatePaymentBasicDto() {
            CardNumber = "4012000033330026",
            CardHolder = "Willie E. Coyote",
            ExpiryMonth = "05",
            ExpiryYear = "29",
            Cvv = "123"
        };
    }

    /// <summary>
    /// Converts CreatePaymentBasicDto to CreatePaymentRequest
    /// </summary>
    /// <param name="createPaymentBasicDto">Dto that needs to be converted</param>
    /// <returns>Instance of CreatePaymentRequest</returns>
    public CreatePaymentRequest ToCreatePaymentRequest(CreatePaymentBasicDto createPaymentBasicDto) {
        return new CreatePaymentRequest() {
            CardPaymentMethodSpecificInput = new CardPaymentMethodSpecificInput() {
                Card = new Card() {
                    CardNumber = createPaymentBasicDto.CardNumber,
                    CardholderName = createPaymentBasicDto.CardHolder,
                    ExpiryDate = string.Format("{0}{1}", createPaymentBasicDto.ExpiryMonth, createPaymentBasicDto.ExpiryYear),
                    Cvv = createPaymentBasicDto.Cvv
                },
                PaymentProductId = 1
            },
            Order = new Order() {
                AmountOfMoney = new AmountOfMoney() {
                    Amount = ToAmount(createPaymentBasicDto.Amount),
                    CurrencyCode = createPaymentBasicDto.Currency
                },
                Customer = new Customer() {
                    Device = new CustomerDevice() {
                        AcceptHeader = "text/html,application/xhtml+xml,application/xml;q=0.9,/;q=0.8",
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
