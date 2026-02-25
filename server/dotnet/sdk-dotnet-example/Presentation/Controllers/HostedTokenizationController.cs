using Business.DTOs.HostedTokenizations;
using Business.Interfaces.Services;
using Microsoft.AspNetCore.Mvc;
using Presentation.Mappers;
using Presentation.Models.GetHostedTokenizations;

namespace Presentation.Controllers;

[ApiController]
public class HostedTokenizationController : ControllerBase
{
    [HttpGet("tokens")]
    public async Task<ActionResult<GetHostedTokenizationResponse>> GetHostedTokenizationAsync(
        [FromServices] IHostedTokenizationService hostedTokenizationService)
    {
        GetHostedTokenizationResponseDto responseDto = await hostedTokenizationService.InitHostedTokenizationAsync();
            
        return Ok(HostedTokenizationMapper.Map(responseDto));
    }
}