namespace Configuration.AppSettings;

public class AppSettings
{
    public required string MerchantId { get; set; }
    
    public required string ApiKey { get; set; } 
    
    public required string ApiSecret { get; set; }
    
    public required string ApiEndpoint { get; set; }
    
    public required bool UseCommunicatorConfiguration { get; set; }
}