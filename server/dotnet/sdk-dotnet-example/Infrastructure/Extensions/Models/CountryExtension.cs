using Business.Domain.Common.Enums;

namespace Infrastructure.Extensions.Models;

public static class CountryExtension
{
    private static readonly Dictionary<Country, string> CountryIsoCodes = new()
    {
        { Country.England, "GB" },
        { Country.Germany, "DE" },
        { Country.France, "FR" }
    };
    
    public static string? ToIsoAlpha2(this Country? country)
    {
        return country == null ? string.Empty : CountryIsoCodes.GetValueOrDefault(country.Value);
    }
}