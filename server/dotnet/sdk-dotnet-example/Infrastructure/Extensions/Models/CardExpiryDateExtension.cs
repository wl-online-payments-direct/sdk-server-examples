namespace Infrastructure.Extensions.Models;

public static class CardExpiryDateExtension
{
    public static string GetYearSuffix(this string? year)
    {
        return year == null ? string.Empty : year[^2..];
    }
}