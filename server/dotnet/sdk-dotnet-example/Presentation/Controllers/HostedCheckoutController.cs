using Business.DTOs.CreateHostedCheckouts;
using Business.DTOs.GetPaymentByHostedCheckoutId;
using Business.Interfaces.Services;
using Microsoft.AspNetCore.Mvc;
using Presentation.Mappers;
using Presentation.Models.CreateHostedCheckouts;
using Presentation.Models.GetPaymentByHostedCheckoutId;

namespace Presentation.Controllers;

[ApiController]
[Route("sessions")]
public class HostedCheckoutController : ControllerBase
{
    [HttpPost]
    public async Task<ActionResult<CreateHostedCheckoutResponse>> CreateHostedCheckoutSessionsAsync(
        [FromServices] IHostedCheckoutService hostedCheckoutService,
        [FromBody] CreateHostedCheckoutRequest request)
    {
        CreateHostedCheckoutResponseDto responseDto =
            await hostedCheckoutService.CreateHostedCheckoutSessionsAsync(
                HostedCheckoutMapper.Map(request));

        return Created(string.Empty, HostedCheckoutMapper.Map(responseDto));
    }

    [HttpGet("{id}")]
    public async Task<ActionResult<GetPaymentByHostedCheckoutIdResponse>> GetPaymentByHostedCheckoutIdAsync(
        [FromRoute] string id,
        [FromServices] IHostedCheckoutService hostedCheckoutService)
    {
        GetPaymentByHostedCheckoutIdResponseDto?
            result = await hostedCheckoutService.GetPaymentByHostedCheckoutIdAsync(id);
        if (result == null)
        {
            return NotFound("Payment not found.");
        }

        return Ok(HostedCheckoutMapper.Map(result));
    }
}