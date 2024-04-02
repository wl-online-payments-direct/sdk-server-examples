namespace OnlinePayments.Sdk.Example;

/// <summary>
/// Basic Dto for hosted tokenization used for testing purposes
/// </summary>
public class CreateHostedTokenizationBasicDto
{
    public decimal Amount { get; set; }

    public string? Currency { get; set; }

    public string? HostedTokenizationId { get; set; }

}
