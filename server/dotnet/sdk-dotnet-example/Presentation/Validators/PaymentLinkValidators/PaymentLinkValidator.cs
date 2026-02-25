using Business.Domain.Common.Enums;
using Business.Domain.Enums.PaymentLinks;
using FluentValidation;
using Presentation.Models.CreatePaymentLinks;
using Action = Business.Domain.Enums.PaymentLinks.Action;

namespace Presentation.Validators.PaymentLinkValidators;

public class PaymentLinkValidator : AbstractValidator<CreatePaymentLinkRequest>
{
    public PaymentLinkValidator()
    {
        ValidatorOptions.Global.DefaultClassLevelCascadeMode = CascadeMode.Stop;

        RuleFor(x => x.Amount)
            .NotEmpty()
            .WithMessage("The Amount field is required.")
            .GreaterThan(0)
            .WithMessage("The Amount field must be greater than zero.");
        
        RuleFor(x => x.Description)
            .MaximumLength(1000)
            .When(x => !string.IsNullOrEmpty(x.Description))
            .WithMessage("Description field must be shorter than 1000 characters.");

        RuleFor(x => x.Currency)
            .NotEmpty()
            .WithMessage("The Currency field is required.")
            .IsInEnum()
            .WithMessage("The Currency field is invalid.")
            .Must(c => c is Currency.EUR or Currency.USD)
            .WithMessage("The Currency field is invalid.");

        RuleFor(x => x.ValidFor)
            .NotEmpty()
            .WithMessage("The ValidFor field is required.")
            .Must(c => c is ValidityPeriod.OneDay 
                or ValidityPeriod.TwoDays 
                or ValidityPeriod.TwoWeeks 
                or ValidityPeriod.OneMonth)
            .WithMessage("The ValidFor field is invalid and must be a number from the following set: 24, 48, 336, 720.");

        RuleFor(x => x.Action)
            .NotEmpty()
            .WithMessage("The Action field is required.")
            .IsInEnum()
            .WithMessage("The Action field is invalid.")
            .Must(c => c is Action.CREATE or Action.PREVIEW).WithMessage("The Action field is invalid.");
    }
}