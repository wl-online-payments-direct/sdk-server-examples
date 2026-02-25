using Business.Domain.Common.Enums;
using FluentValidation;
using Presentation.Models.AdditionalPaymentActions;

namespace Presentation.Validators.AdditionalPaymentActionValidators;

public class AdditionalPaymentActionValidator  : AbstractValidator<AdditionalPaymentActionRequest>
{
    public AdditionalPaymentActionValidator()
    {
        ValidatorOptions.Global.DefaultClassLevelCascadeMode = CascadeMode.Stop;
        
        RuleFor(x => x.Amount)
            .NotEmpty()
            .WithMessage("The Amount field is required.")
            .GreaterThan(0)
            .WithMessage("The Amount must be greater than zero.");
        
        RuleFor(x => x.Currency)
            .NotEmpty()
            .WithMessage("The Currency field is required.")
            .IsInEnum()
            .WithMessage("The Currency field is invalid.")
            .Must(c => c is Currency.EUR or Currency.USD)
            .WithMessage("The Currency field is invalid.");
    }
}