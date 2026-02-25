using Business.Domain.Payments;

namespace Presentation.Extensions;

public static class CardExtensions
{
    public static bool HasFutureExpiryDate(this Card? card)
    {
        if (!int.TryParse(card?.ExpiryMonth, out var month) || !int.TryParse(card?.ExpiryYear, out var year))
        {
            return false;
        }

        try
        {
            DateTime expiryDate = new DateTime(year, month, 1).AddMonths(1).AddDays(-1);
            
            return expiryDate >= DateTime.UtcNow.Date;
        }
        catch
        {
            return false;
        }
    }
}