# Online payments Java SDK Example

This example app illustrates the use of the Online Payments Java SDK and the services provided by the Online Payments platform.

## Recommended Development Environment

- IntelliJ IDEA or Eclipse

## How To Run

### Running locally:

```markdown
Prerequisites:
- JDK 21
- [Git](https://git-scm.com/)
``` 

#### Configuration (application.properties)

Before running the backend, you must configure the required credentials in `application.properties` in
`java/src/main/resources`.  
You can use `application.properties.example` as a template.
Update `merchantId`, `apiKey`, `apiSecret` and `apiEndpoint` with valid values for your environment.

#### Clean build (recommended)

Run these commands before starting the backend:

```bash
  mvn clean install
  mvn spring-boot:run
```

#### Running the backend through IDE

Running the Backend in IntelliJ:

1. Open IntelliJ.
2. Go to: File → Open… and select: server/server/java.
3. Go to Run → Edit Configurations... .
4. Make sure selected Java version is 21 or higher.
5. For the main class, select `com.onlinepayments.example.Application` and save the configuration.
6. The backend will start and run using its default configuration.

After startup, the backend will be available on the `http://localhost:3000`.

### Running on Docker:

```markdown
Prerequisites:
- Docker installed and running
```

#### Clean build (recommended)
Run this command before starting the backend:

```bash
#in cmd:
rmdir /s /q target
```
```bash
#in powershell:
Remove-Item -Recurse -Force .\target
```

#### Build the Docker image and run from the terminal
```bash
docker build -t java-sdk-example .

docker run --rm -p 3000:3000 java-sdk-example
```

#### Running from IDE (IntelliJ)

1. Go to Run → Edit Configurations.
2. Click Add New → From Dockerfile.
3. Enter a name for the Docker image (e.g., java-sdk-example).
4. Go to Modify Run Options and enable Bind Ports.
5. Go to Browse to open the port mapping dialog and click the + button to add a port mapping:
   - Host port: 3000
   - Container port: 3000
6. Save the configuration.
7. Run the configuration in IntelliJ.

After startup, the backend will be available on the http://localhost:3000.