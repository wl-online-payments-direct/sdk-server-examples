namespace OnlinePayments.Sdk.Example;

/// <summary>
/// Basic Dto for hosted checkout used for testing purposes
/// </summary>
public class CreateHostedCheckoutBasicDto
{
    public decimal Amount { get; set; }

    public string? Currency { get; set; }

    public string? RedirectUrl { get; set; }

}
