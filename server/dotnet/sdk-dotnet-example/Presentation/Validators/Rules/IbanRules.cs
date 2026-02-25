using System.Text.RegularExpressions;
using Business.Domain.Common.Enums;
using FluentValidation;

namespace Presentation.Validators.Rules;

internal static class IbanRules
{
    private static readonly Regex BasicIbanRx =
        new(@"^[A-Z]{2}\d{2}[A-Z0-9]+$", RegexOptions.Compiled);
    
    public static string Clean(string? iban) =>
        new string((iban ?? string.Empty).Where(char.IsLetterOrDigit).ToArray()).ToUpperInvariant();
    
    private static (string Prefix, int Length)? SpecFor(Country country) =>
        country switch
        {
            Country.France  => ("FR", 27),
            Country.Germany => ("DE", 22),
            Country.England => ("GB", 22),
            _               => null
        };

    private static bool HasValidChecksum(string iban)
    {
        var rear = iban[4..] + iban[..4];

        int remainder = 0;
        foreach (var ch in rear)
        {
            var digits = char.IsLetter(ch) ? ((ch - 'A') + 10).ToString() : ch.ToString();
            foreach (var d in digits)
            {
                remainder = (remainder * 10 + (d - '0')) % 97;
            }
        }
        return remainder == 1;
    }

    public static IRuleBuilderOptions<T, string?> MustHaveBasicIbanFormat<T>(
        this IRuleBuilder<T, string?> rule)
    {
        return rule
            .Must(value =>
            {
                if (string.IsNullOrWhiteSpace(value)) return true;
                var iban = Clean(value);
                return BasicIbanRx.IsMatch(iban);
            })
            .WithMessage("IBAN format is invalid (expected: 2 letters country + 2 digits + alphanumerics).");
    }

    public static IRuleBuilderOptions<T, string?> MustMatchIbanCountryAndLength<T>(
        this IRuleBuilder<T, string?> rule,
        Func<T, Country> countrySelector)
    {
        return rule
            .Must((obj, value) =>
            {
                if (string.IsNullOrWhiteSpace(value)) return true; 
                var spec = SpecFor(countrySelector(obj));
                if (spec is null) return false;

                var iban = Clean(value);
                return iban.StartsWith(spec.Value.Prefix) && iban.Length == spec.Value.Length;
            })
            .WithMessage(obj =>
            {
                var c = countrySelector(obj);
                var spec = SpecFor(c);
                return spec is null
                    ? "IBAN country is not supported."
                    : $"IBAN must start with '{spec.Value.Prefix}' and be {spec.Value.Length} characters for {c}.";
            });
    }

    public static IRuleBuilderOptions<T, string?> MustHaveValidIbanChecksum<T>(
        this IRuleBuilder<T, string?> rule)
    {
        return rule
            .Must(value =>
            {
                if (string.IsNullOrWhiteSpace(value)) return true;
                var iban = Clean(value);
                if (!BasicIbanRx.IsMatch(iban)) return false;
                return HasValidChecksum(iban);
            })
            .WithMessage("IBAN checksum is invalid.");
    }
}