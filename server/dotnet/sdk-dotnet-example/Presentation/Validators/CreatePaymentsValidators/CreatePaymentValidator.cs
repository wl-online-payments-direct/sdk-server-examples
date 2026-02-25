using Business.Domain.Common.Enums;
using Business.Domain.Enums.Payments;
using FluentValidation;
using FluentValidation.Results;
using Presentation.Extensions;
using Presentation.Models.CreatePayments;
using Presentation.Validators.Rules;

namespace Presentation.Validators.CreatePaymentsValidators;

public class CreatePaymentValidator : AbstractValidator<CreatePaymentRequest>
{
    protected override bool PreValidate(ValidationContext<CreatePaymentRequest> context, ValidationResult result)
    {
        var m = context.InstanceToValidate?.Mandate;
        if (!string.IsNullOrWhiteSpace(m?.IBAN))
        {
            m.IBAN = IbanRules.Clean(m.IBAN); 
        }
        
        return base.PreValidate(context, result);
    }

    public CreatePaymentValidator()
    {
        ValidatorOptions.Global.DefaultClassLevelCascadeMode = CascadeMode.Stop;

        RuleFor(x => x)
            .Must(x =>
            {
                if (string.IsNullOrWhiteSpace(x.HostedTokenizationId))
                {
                    return true;
                }

                if (x.Card == null)
                {
                    return true;
                } 

                return string.IsNullOrWhiteSpace(x.Card.Number)
                       && string.IsNullOrWhiteSpace(x.Card.HolderName)
                       && string.IsNullOrWhiteSpace(x.Card.VerificationCode)
                       && string.IsNullOrWhiteSpace(x.Card.ExpiryMonth)
                       && string.IsNullOrWhiteSpace(x.Card.ExpiryYear);
            })
            .WithMessage("If hosted tokenization id is provided, card details must not be filled.");

        RuleFor(x => x.Amount)
            .NotEmpty()
            .WithMessage("The Amount field is required.")
            .GreaterThan(0)
            .WithMessage("The Amount field must be greater than zero.");

        RuleFor(x => x.Currency)
            .NotEmpty()
            .WithMessage("The Currency field is required.")
            .IsInEnum()
            .Must(c => c is Currency.EUR or Currency.USD)
            .WithMessage("The Currency field is invalid.");

        RuleFor(x => x.Method)
            .NotEmpty()
            .WithMessage("The Method field is required.")
            .IsInEnum()
            .Must(c => c is PaymentMethodType.TOKEN or PaymentMethodType.CREDIT_CARD or PaymentMethodType.DIRECT_DEBIT)
            .WithMessage("The Method field is invalid.");
        
        RuleFor(x => x.Card)
            .Must(card =>
            {
                if (card == null) return false;

                var isEmpty = string.IsNullOrWhiteSpace(card.Number) &&
                              string.IsNullOrWhiteSpace(card.HolderName) &&
                              string.IsNullOrWhiteSpace(card.VerificationCode) &&
                              string.IsNullOrWhiteSpace(card.ExpiryMonth) &&
                              string.IsNullOrWhiteSpace(card.ExpiryYear);

                return !isEmpty;
            })
            .WithMessage("The Card object is required.")
            .ChildRules(card =>
            {
                card.RuleFor(c => c!.Number)
                    .NotEmpty().WithMessage("The Card.Number field is required.")
                    .Must(value => value != null && value.All(char.IsDigit))
                    .WithMessage("The Card.Number field must contain only digits.")
                    .MaximumLength(19).WithMessage("The Card.Number field must be shorter than 20 characters");

                card.RuleFor(c => c!.HolderName)
                    .NotEmpty().WithMessage("The Card.HolderName field is required.");

                card.RuleFor(c => c!.VerificationCode)
                    .NotEmpty().WithMessage("The Card.VerificationCode field is required.")
                    .Must(v => v != null && v.All(char.IsDigit) && v.Length is 3 or 4)
                    .WithMessage("The Card.VerificationCode must be 3 or 4 digits long.");

                card.RuleFor(c => c!.ExpiryMonth)
                    .Cascade(CascadeMode.Stop)
                    .NotEmpty().WithMessage("The Card.ExpiryMonth field is required.")
                    .Length(2).WithMessage("The Card.ExpiryMonth must be 2 digits long.")
                    .Must(value => int.TryParse(value, out _)).WithMessage("The Card.ExpiryMonth must be a number.")
                    .Must(value => int.TryParse(value, out var m) && m is >= 1 and <= 12)
                    .WithMessage("The Card.ExpiryMonth must be a number between 01 and 12.");

                card.RuleFor(c => c!.ExpiryYear)
                    .Cascade(CascadeMode.Stop)
                    .NotEmpty().WithMessage("The Card.ExpiryYear field is required.")
                    .Length(4).WithMessage("The Card.ExpiryYear must be 4 digits long.")
                    .Must(value => int.TryParse(value, out _)).WithMessage("The Card.ExpiryYear must be a number.");

                card.RuleFor(c => c)
                    .Must(c => c.HasFutureExpiryDate())
                    .WithMessage("The card expiry date must be in the future.")
                    .When(c => !string.IsNullOrEmpty(c!.ExpiryMonth) && !string.IsNullOrEmpty(c.ExpiryYear));
            })
            .When(x => x.Method == PaymentMethodType.CREDIT_CARD);

        RuleFor(x => x.Mandate)
        .Must(mandate =>
        {
            if (mandate == null) return false;
            
            return !(string.IsNullOrWhiteSpace(mandate.CustomerReference) &&
                     string.IsNullOrWhiteSpace(mandate.IBAN) &&
                     string.IsNullOrWhiteSpace(mandate.MandateReference) &&
                     mandate.RecurrenceType == null &&
                     mandate.SignatureType == null &&
                     string.IsNullOrWhiteSpace(mandate.ReturnUrl) &&
                     mandate.Address == null);
        })
        .WithMessage("Mandate is required for DIRECT_DEBIT payments.")
        .When(x => x.Method == PaymentMethodType.DIRECT_DEBIT);

        RuleFor(x => x.Mandate)
            .ChildRules(mandate =>
            {
                mandate.RuleFor(m => m!.CustomerReference)
                    .NotEmpty()
                    .WithMessage("The CustomerReference field is required.")
                    .MaximumLength(35)
                    .WithMessage("The CustomerReference field must be shorter than 36 characters.");

                mandate.RuleFor(m => m!.IBAN)
                    .Cascade(CascadeMode.Stop)
                    .NotEmpty().WithMessage("The IBAN field is required when mandate reference is not provided.")
                    .MustHaveBasicIbanFormat()
                    .MustMatchIbanCountryAndLength(m => m!.Address!.Country!.Value)
                    .When(m => m is { Address.Country: not null })
                    .MustHaveValidIbanChecksum()
                    .MaximumLength(50).WithMessage("The IBAN field must be shorter than 51 characters.")
                    .OverridePropertyName("mandate.iban")
                    .When(m => string.IsNullOrWhiteSpace(m!.MandateReference));

                mandate.RuleFor(m => m!.RecurrenceType)
                    .NotEmpty()
                    .WithMessage("The RecurrenceType field is required.")
                    .IsInEnum()
                    .Must(c => c is RecurrenceType.UNIQUE or RecurrenceType.RECURRING)
                    .WithMessage(
                        "The RecurrenceType field is required and must have one of the following values: UNIQUE or RECURRING.");

                mandate.RuleFor(m => m!.SignatureType)
                    .NotEmpty()
                    .WithMessage("The SignatureType field is required.")
                    .IsInEnum()
                    .Must(c => c is SignatureType.SMS or SignatureType.TICK_BOX or SignatureType.UNSIGNED)
                    .WithMessage(
                        "The SignatureType field is required and must have one of the following values: SMS, UNSIGNED or TICK_BOX.");

                mandate.RuleFor(m => m!.ReturnUrl)
                    .Must(url => Uri.TryCreate(url, UriKind.Absolute, out var uri) &&
                                 (uri.Scheme == Uri.UriSchemeHttp || uri.Scheme == Uri.UriSchemeHttps))
                    .When(m => !string.IsNullOrEmpty(m!.ReturnUrl))
                    .WithMessage("The ReturnUrl field is invalid.");

                mandate.RuleFor(m => m!.Address)
                    .NotEmpty()
                    .WithMessage("Address is required when mandate reference is not provided.")
                    .When(m => string.IsNullOrWhiteSpace(m?.MandateReference));
                
                mandate.RuleFor(m => m!.Address)
                    .ApplyAddressRules("Mandate.Address")
                    .When(m => string.IsNullOrWhiteSpace(m?.MandateReference));
            })
            .When(x =>
            {
                if (x.Method != PaymentMethodType.DIRECT_DEBIT || x.Mandate == null)
                    return false;
                
                var isEmpty = string.IsNullOrWhiteSpace(x.Mandate.CustomerReference) &&
                              string.IsNullOrWhiteSpace(x.Mandate.IBAN) &&
                              string.IsNullOrWhiteSpace(x.Mandate.MandateReference) &&
                              x.Mandate.RecurrenceType == null &&
                              x.Mandate.SignatureType == null &&
                              string.IsNullOrWhiteSpace(x.Mandate.ReturnUrl) &&
                              x.Mandate.Address == null;
                
                return !isEmpty;
            });
    }
}