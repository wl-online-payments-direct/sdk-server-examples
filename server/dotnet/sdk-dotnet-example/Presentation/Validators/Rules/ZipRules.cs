using System.Text.RegularExpressions;
using FluentValidation;
using Business.Domain.Common.Enums;

namespace Presentation.Validators.Rules;

internal static class ZipRules
{
    private static readonly Regex UkPostcodeRx =
        new(@"^([Gg][Ii][Rr]\s?0[Aa]{2}|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-HJ-Ya-hj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-HJ-Ya-hj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2}))$",
            RegexOptions.Compiled);
    
    private static bool IsZipValidForCountry(string? zip, Country country)
    {
        if (string.IsNullOrWhiteSpace(zip))
            return false;

        var z = zip.Trim();

        return country switch
        {
            Country.France  => Regex.IsMatch(z, @"^(?:0[1-9]|[1-8]\d|9[0-5]|97[1-8]|98\d)\d{3}$"),
            Country.Germany => Regex.IsMatch(z, @"^(0[1-9]\d{3}|[1-9]\d{4})$"),
            Country.England => UkPostcodeRx.IsMatch(z),
            _               => false
        };
    }

    
    public static IRuleBuilderOptions<T, string?> MustBeValidZipForCountry<T>(
        this IRuleBuilder<T, string?> rule,
        Func<T, Country> countrySelector)
    {
        return rule
            .Must((obj, zip) => IsZipValidForCountry(zip, countrySelector(obj)))
            .WithMessage(obj =>
            {
                var c = countrySelector(obj);
                return c switch
                {
                    Country.France  => "Zip code must be 5 digits for France.",
                    Country.Germany => "Zip code must be 5 digits for Germany.",
                    Country.England => "UK postcode must be in a valid format (e.g., SW1A 2AA, W1A 0AX, M1 1AE).",
                    _               => "Zip/postal code is invalid for the selected country."
                };
            });
    }
}