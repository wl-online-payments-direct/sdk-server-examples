# Online payments .NET SDK Example

This example app illustrates the use of the Online Payments .NET SDK and the services provided by the Online Payments
platform.

## Recommended Development Environment

- JetBrains Rider (recommended) or Visual Studio

## How To Run

### Running locally:

```markdown
Prerequisites:

- .NET 9+
- [Git](https://git-scm.com/)
``` 

#### Configuration (appsettings.json)

Before running the backend, you must configure the required credentials in `appsettings.json`.  
Update `MerchantId`, `ApiKey`, `ApiSecret` and `ApiEndpoint` with valid values for your environment.

#### Clean build (recommended)

Run these commands before starting the backend:

```bash
  dotnet clean
  dotnet build
```

#### Running the backend through IDE

Running the Backend in Rider:

1. Open Rider.
2. Go to: File → Open… and select: `server/dotnet/sdk-dotnet-example.sln`
3. Rider will load all .NET projects contained in this solution.
4. In the Solution Explorer, select the Presentation project.
5. Right-click the project → Run 'Presentation'.
6. The backend will start and run using its default configuration.

After startup, the backend will be available on the `http://localhost:3000`.

### Running on Docker:

```markdown
Prerequisites:
- Docker installed and running
```

#### Build the Docker image and run from the terminal

```bash
docker build -t sdk-dotnet-example .

docker run -d -p 3000:3000 \
  -e AppSettings__MerchantId=<your-merchant-id> \
  -e AppSettings__ApiKey=<your-api-key> \
  -e AppSettings__ApiSecret=<your-api-secret> \
  -e AppSettings__ApiEndpoint=<api-endpoint> \
  --name sdk-dotnet-example \
  sdk-dotnet-example
```

Replace the placeholder values with your actual credentials.

After startup, the backend will be available on `http://localhost:3000`.
