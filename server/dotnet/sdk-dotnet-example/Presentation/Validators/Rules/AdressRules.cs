using FluentValidation;
using Business.Domain.Common;

namespace Presentation.Validators.Rules;

internal static class AddressRules
{
    public static IRuleBuilderOptions<T, AddressDto?> ApplyAddressRules<T>(
        this IRuleBuilder<T, AddressDto?> rule,
        string? prefix = null)
    {
        return rule.ChildRules(address =>
        {
            address.RuleFor(a => a!.FirstName)
                .NotEmpty()
                .WithMessage($"The {prefix}.FirstName field is required.");
            
            address.RuleFor(a => a!.LastName)
                .NotEmpty()
                .WithMessage($"The {prefix}.LastName field is required.");

            address.RuleFor(a => a!.Street)
                .NotEmpty()
                .WithMessage($"The {prefix}.Street field is required.");

            address.RuleFor(a => a!.City)
                .NotEmpty()
                .WithMessage($"The {prefix}.City field is required.");
            
            address.RuleFor(a => a!.Country)
                .NotEmpty()
                .WithMessage($"The {prefix}.Country field is required.")
                .IsInEnum()
                .WithMessage($"The {prefix}.Country field is invalid.");

            address.RuleFor(a => a!.Zip)
                .NotEmpty()
                .WithMessage($"The {prefix}.Zip field is required.")
                .MustBeValidZipForCountry(a => a!.Country!.Value);
        });
    }
}
