using Business.Domain.Common.Enums;
using FluentValidation;
using Presentation.Models.CreateHostedCheckouts;
using Presentation.Validators.Rules;

namespace Presentation.Validators.HostedCheckoutValidators;

public class CreateHostedCheckoutValidator : AbstractValidator<CreateHostedCheckoutRequest>
{
    public CreateHostedCheckoutValidator()
    {
        ValidatorOptions.Global.DefaultClassLevelCascadeMode = CascadeMode.Stop;

        RuleFor(x => x.Amount)
            .NotEmpty()
            .WithMessage("The Amount field is required.")
            .GreaterThan(0)
            .WithMessage("The Amount field must be greater than zero.");
        
        RuleFor(x => x.Currency)
            .NotEmpty()
            .WithMessage("The Currency field is required.")
            .IsInEnum()
            .WithMessage("The Currency field is invalid.")
            .Must(c => c is Currency.EUR or Currency.USD)
            .WithMessage("The Currency field is invalid.");
        
        RuleFor(x => x.Language)
            .NotEmpty()
            .WithMessage("The Language field is required.")
            .IsInEnum()
            .WithMessage("The Language field is invalid.")
            .Must(c => c is Language.English or Language.French or Language.German)
            .WithMessage("The Language field is invalid.");

        RuleFor(x => x.RedirectUrl)
            .Must(url => Uri.TryCreate(url, UriKind.Absolute, out var uri) && 
                         (uri.Scheme == Uri.UriSchemeHttp || uri.Scheme == Uri.UriSchemeHttps))
            .When(x => !string.IsNullOrEmpty(x.RedirectUrl))
            .WithMessage("The RedirectUrl field is invalid.");

        RuleFor(x => x.BillingAddress).ChildRules(address =>
            {
                address.RuleFor(a => a!.Country)
                    .NotEmpty()
                    .WithMessage("The BillingAddress.Country field is required.")
                    .IsInEnum()
                    .Must(c => c is Country.England or Country.France or Country.Germany)
                    .WithMessage("Unsupported billing country.")
                    .OverridePropertyName("billingAddress.country");

                address.RuleFor(a => a!.Zip)!
                    .MustBeValidZipForCountry(a => a!.Country!.Value)
                    .OverridePropertyName("billingAddress.zip")
                    .When(a => !string.IsNullOrWhiteSpace(a!.Zip) && a.Country != null);
            })
            .When(x => x.BillingAddress != null);

        RuleFor(x => x.ShippingAddress).ChildRules(address =>
            {
                address.RuleFor(a => a!.Country)
                    .NotEmpty()
                    .WithMessage("The ShippingAddress.Country field is required.")
                    .IsInEnum()
                    .Must(c => c is Country.England or Country.France or Country.Germany)
                    .WithMessage("Unsupported billing country.")
                    .OverridePropertyName("billingAddress.country");

                address.RuleFor(a => a!.Zip)!
                    .MustBeValidZipForCountry(a => a!.Country!.Value)
                    .OverridePropertyName("shippingAddress.zip")
                    .When(a => !string.IsNullOrWhiteSpace(a!.Zip) && a.Country != null);
            })
            .When(x => x.ShippingAddress != null);
    }
}