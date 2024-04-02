using Microsoft.AspNetCore.Mvc;
using OnlinePayments.Sdk.Domain;

namespace OnlinePayments.Sdk.Example;

[Route("api/createpayment")]
[ApiController]
public class CreatePaymentController
{
    private readonly CreatePaymentMapper _createPaymentMapper;
    private readonly CreatePaymentService _createPaymentService;
    private readonly PaymentDetailsService _paymentDetailsService;

    public CreatePaymentController(
        CreatePaymentMapper createPaymentMapper,
        CreatePaymentService createPaymentService,
        PaymentDetailsService paymentDetailsService
    )
    {
        _createPaymentMapper = createPaymentMapper;
        _createPaymentService = createPaymentService;
        _paymentDetailsService = paymentDetailsService;
    }

    [HttpGet]
    public CreatePaymentBasicDto InitializeRequest() {
        return _createPaymentMapper.ToEmptyBasicDto();
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
    public async Task<CreatePaymentResponse> CreatePaymentResponse(
        [FromBody] CreatePaymentBasicDto createPaymentBasicDto
    ) {
        return await _createPaymentService.CreatePayment(
                _createPaymentMapper.ToCreatePaymentRequest(createPaymentBasicDto));
    }

}
