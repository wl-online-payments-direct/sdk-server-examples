using Business.Domain.Common.Enums;

namespace Infrastructure.Extensions.Models;

public static class LanguageExtensions
{
    private static readonly Dictionary<Language, string> LanguageIsoCodes = new()
    {
        { Language.English, "en" },
        { Language.German, "de" },
        { Language.French, "fr" }
    };
    
    public static string ToLocale(this Language? language, Country? country)
    {
        if (!language.HasValue || !country.HasValue)
        {
            return string.Empty;
        }

        if (!LanguageIsoCodes.TryGetValue(language.Value, out var languageCode))
        {
            return string.Empty;
        }

        string? countryCode = country.ToIsoAlpha2();
        
        return string.IsNullOrEmpty(countryCode) ? string.Empty : $"{languageCode}-{countryCode}";
    }
}