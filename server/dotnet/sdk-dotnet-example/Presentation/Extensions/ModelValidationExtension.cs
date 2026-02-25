using Microsoft.AspNetCore.Mvc;

namespace Presentation.Extensions;

public static class ModelValidationExtension
{
    public static string? GetFirstValidationError(this ActionContext context)
    {
        var jsonPathEntry = context.ModelState
            .Where(e => e.Key.StartsWith("$.") && e.Value?.Errors.Count > 0)
            .Select(e => new { Path = e.Key, Message = e.Value!.Errors.First().ErrorMessage })
            .FirstOrDefault();
        if (jsonPathEntry != null)
        {
            string field = jsonPathEntry.Path.TrimStart('$', '.');

            field = string.Join('.',
                field.Split('.')
                    .Select(p => char.ToUpper(p[0]) + p[1..])
            );

            return $"The {field} field is invalid.";
        }


        string? firstFieldError = context.ModelState
            .Where(e => e.Value?.Errors.Count > 0)
            .Select(e => e.Value!.Errors.First().ErrorMessage)
            .FirstOrDefault();

        return firstFieldError;
    }
}