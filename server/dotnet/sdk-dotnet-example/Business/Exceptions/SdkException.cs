using System.Net;

namespace Business.Exceptions;

public class SdkException(
    string? message,
    HttpStatusCode statusCode) : Exception(message)
{
    public HttpStatusCode StatusCode { get; } = statusCode;
}