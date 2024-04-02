using System.Runtime.ConstrainedExecution;
using Microsoft.AspNetCore.Mvc;
using OnlinePayments.Sdk.Domain;

namespace OnlinePayments.Sdk.Example;

[Route("api/hostedcheckout")]
[ApiController]
public class HostedCheckoutController : ControllerBase
{
    private readonly HostedCheckoutMapper _hostedCheckoutMapper;
    private readonly HostedCheckoutService _hostedCheckoutService;
    private readonly PaymentDetailsService _paymentDetailsService;

    public HostedCheckoutController(
        HostedCheckoutMapper hostedCheckoutMapper,
        HostedCheckoutService hostedCheckoutService,
        PaymentDetailsService paymentDetailsService
    )
    {
        _hostedCheckoutMapper = hostedCheckoutMapper;
        _hostedCheckoutService = hostedCheckoutService;
        _paymentDetailsService = paymentDetailsService;
    }
    
    [HttpGet]
    public CreateHostedCheckoutBasicDto GetHostedCheckout() {
        return _hostedCheckoutMapper.ToEmptyDto();
    }

    [HttpGet("outcome")]
    public async Task<PaymentDetailsResponse> GetPaymentResponse(
        [FromQuery] string RETURNMAC,
        [FromQuery] string hostedCheckoutId
    ) {
        if (hostedCheckoutId == null)
            throw new Exception("Hosted checkout id is missing!");

        return await _paymentDetailsService.GetPaymentDetailsForHostedCheckout(hostedCheckoutId);

    }

    [HttpPost("basic")]
    public async Task<CreateHostedCheckoutResponse> CreateHostedCheckout(
        [FromBody] CreateHostedCheckoutBasicDto createHostedCheckoutBasicDto
    ) {
        return await _hostedCheckoutService.CreateHostedCheckoutResponse(
                _hostedCheckoutMapper.ToCreateHostedCheckoutRequest(createHostedCheckoutBasicDto));
    }

}
