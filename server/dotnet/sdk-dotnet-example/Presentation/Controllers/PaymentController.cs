using Business.DTOs.AdditionalPaymentActions;
using Business.DTOs.CreatePayments;
using Business.DTOs.GetPaymentDetails;
using Business.Interfaces.Services;
using Microsoft.AspNetCore.Mvc;
using Presentation.Mappers;
using Presentation.Extensions;
using Presentation.Models.AdditionalPaymentActions;
using Presentation.Models.CreatePayments;
using Presentation.Models.GetPaymentDetails;

namespace Presentation.Controllers;

[ApiController]
[Route("payments")]
public class PaymentController : ControllerBase
{
    [HttpPost]
    public async Task<ActionResult<CreatePaymentResponse>> CreatePaymentAsync(
        [FromServices] IPaymentService paymentService,
        [FromBody] CreatePaymentRequest request)
    {
        CreatePaymentResponseDto response =
            await paymentService.CreatePaymentAsync(PaymentMapper.Map(request));

        return CreatedAtAction(nameof(GetPaymentDetailsById),
            new { id = response.Id }, PaymentMapper.Map(response));
    }

    [HttpPost("{id}/cancels")]
    public async Task<ActionResult<AdditionalPaymentActionResponse>> CancelPaymentAsync(
        [FromServices] IPaymentService paymentService,
        [FromBody] AdditionalPaymentActionRequest request,
        [FromRoute] string id)
    {
        AdditionalPaymentActionResponseDto response =
            await paymentService.CancelPaymentAsync(request.Map(id));

        return Ok(response.Map());
    }

    [HttpPost("{id}/captures")]
    public async Task<ActionResult<AdditionalPaymentActionResponse>> CapturePaymentAsync(
        [FromServices] IPaymentService paymentService,
        [FromBody] AdditionalPaymentActionRequest request,
        [FromRoute] string id)
    {
        AdditionalPaymentActionResponseDto response =
            await paymentService.CapturePaymentAsync(request.Map(id));

        return Ok(response.Map());
    }

    [HttpPost("{id}/refunds")]
    public async Task<ActionResult<AdditionalPaymentActionResponse>> RefundPaymentAsync(
        [FromServices] IPaymentService paymentService,
        [FromBody] AdditionalPaymentActionRequest request,
        [FromRoute] string id)
    {
        AdditionalPaymentActionResponseDto response =
            await paymentService.RefundPaymentAsync(request.Map(id));

        return Ok(response.Map());
    }

    [HttpGet("{id}")]
    public async Task<ActionResult<PaymentDetailsResponse>> GetPaymentDetailsById(
        [FromRoute] string id,
        [FromServices] IPaymentService paymentService)
    {
        PaymentDetailsResponseDto? result = await paymentService.GetPaymentDetailsById(id);
        if (result == null)
        {
            return NotFound("Payment not found.");
        }

        return Ok(PaymentDetailsMapper.Map(result));
    }
}