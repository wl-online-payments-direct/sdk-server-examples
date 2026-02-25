using Business.Exceptions;
using Configuration.Exceptions;
using Presentation.Models.Errors;

namespace Presentation.Middleware;

public class GlobalExceptionMiddleware(RequestDelegate next, ILogger<GlobalExceptionMiddleware> logger)
{
    public async Task InvokeAsync(HttpContext context)
    {
        try
        {
            await next(context);
        }
        catch (Exception ex)
        {
            logger.LogError(ex, "Exception occurred while processing request.");

            var (statusCode, errorResponse) = MapExceptionToResponse(ex);
            
            context.Response.ContentType = "application/problem+json";
            context.Response.StatusCode = statusCode;

            await context.Response.WriteAsJsonAsync(errorResponse);
        }
    }

    private (int statusCode, object errorResponse) MapExceptionToResponse(Exception ex)
    {
        return ex switch
        {
            SdkException exception => (
                (int)exception.StatusCode,
                new ValidationErrorResponse
                {
                    Message = exception.Message 
                }
            ),
            ConfigurationException exception => (
                StatusCodes.Status422UnprocessableEntity,
                new ValidationErrorResponse
                {
                    Message = exception.Message
                }
            ),
            _ => (
                StatusCodes.Status500InternalServerError,
                new SystemErrorResponse
                {
                    Code = StatusCodes.Status500InternalServerError,
                    Description = "Internal Server Error."
                }
            )
        };
    }
}