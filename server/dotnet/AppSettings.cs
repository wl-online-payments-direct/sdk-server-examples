namespace OnlinePayments.Sdk.Example;

public class AppSettings
{
    public string MerchantId { get; set; }
    public string ApiKey { get; set; } 
    public string ApiSecret { get; set; }
    public string ApiEndpoint { get; set; }
    public string HostedCheckoutRedirectUrl { get; set; }
    public bool UseCommunicatorConfiguration { get; set; }

}
