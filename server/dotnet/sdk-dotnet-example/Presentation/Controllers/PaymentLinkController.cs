using Business.DTOs.CreatePaymentLinks;
using Business.Interfaces.Services;
using Microsoft.AspNetCore.Mvc;
using Presentation.Mappers;
using Presentation.Models.CreatePaymentLinks;

namespace Presentation.Controllers;

[ApiController]
public class PaymentLinkController : ControllerBase
{
    [HttpPost("links")]
    public async Task<ActionResult<CreatePaymentLinkResponse>> CreatePaymentLinkAsync(
        [FromServices] IPaymentLinkService paymentLinkService,
        [FromBody] CreatePaymentLinkRequest request)
    {
        CreatePaymentLinkResponseDto response =
            await paymentLinkService.CreatePaymentLinkAsync(PaymentLinkMapper.Map(request));

        return Created(string.Empty, PaymentLinkMapper.Map(response));
    }
}