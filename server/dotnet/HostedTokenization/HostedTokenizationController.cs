using Microsoft.AspNetCore.Mvc;
using OnlinePayments.Sdk.Domain;

namespace OnlinePayments.Sdk.Example;

[Route("api/hostedtokenization")]
[ApiController]
public class HostedTokenizationController
{
    private readonly HostedTokenizationMapper _hosteTokenizationMapper;
    private readonly HostedTokenizationService _hostedTokenizationService;
    private readonly CreatePaymentService _createPaymentService;
    private readonly PaymentDetailsService _paymentDetailsService;

    public HostedTokenizationController(
        HostedTokenizationMapper hostedTokenizationMapper,
        HostedTokenizationService hostedTokenizationService,
        CreatePaymentService createPaymentService,
        PaymentDetailsService paymentDetailsService
    )
    {
        _hosteTokenizationMapper = hostedTokenizationMapper;
        _hostedTokenizationService = hostedTokenizationService;
        _createPaymentService = createPaymentService;
        _paymentDetailsService = paymentDetailsService;
    }
    
    [HttpGet]
    public async Task<CreateHostedTokenizationResponse> GetHostedTokenization() {
        return await _hostedTokenizationService.InitHostedTokenization();
    }

    [HttpGet("outcome")]
    public async Task<PaymentDetailsResponse> GetPaymentResponse(
        [FromQuery] string paymentId
    ) {
        if (paymentId == null)
            throw new Exception("Payment id is missing!");

        return await _paymentDetailsService.GetPaymentDetails(paymentId);

    }

    [HttpPost("basic")]
    public async Task<CreatePaymentResponse> CreateHostedTokenization(
        [FromBody] CreateHostedTokenizationBasicDto createHostedTokenizationBasicDto
    ) {
        return await _createPaymentService.CreateHostedTokenizationPayment(
                _hosteTokenizationMapper.ToHostedTokenizationPaymentRequest(createHostedTokenizationBasicDto));
    }
}
