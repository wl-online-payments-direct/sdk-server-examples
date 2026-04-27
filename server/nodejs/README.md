# Online payments Node.js SDK Example

This example app illustrates the use of the Online Payments .NET SDK and the services provided by the Online Payments
platform.

## Recommended Development Environment

- IntelliJ or WebStorm

## How To Run

### Running locally:

```markdown
Prerequisites:

- Node.js (version 18 or higher)
- [Git](https://git-scm.com/)
``` 

#### Configuration (.env)

Before running the backend, you must create `nodejs/.env` file and configure the required credentials.  
You can use `.env.example` as a template.
Update `MERCHANT_ID`, `API_KEY`, `API_SECRET` and `API_ENDPOINT` with valid values for your environment.

#### Clean build (recommended)

Run this command before starting the backend:

```bash
#in cmd
rm -rf node_modules
```

```bash
#in powershell
Remove-Item -Recurse -Force .\node_modules
```

#### Running the backend directly from the command line

```bash
yarn install
yarn start
```

#### Running the backend through the IDE

1. Through the IDE (WebStorm)
2. Open WebStorm.
3. Go to File → Open… and select server/nodejs (or your project root).
4. WebStorm will load the project and automatically detect package.json.
5. Go to Run → Edit Configurations….
6. Click + and choose npm.
7. Set Package manager to yarn.
8. Set Command to run and Scripts to start.
9. Click OK to save the configuration.
10. Click Run or press Shift + F10 to start the server.
11. After startup, the backend will be available on the http://localhost:3000.

### Running on Docker:

```markdown
Prerequisites:

- Docker installed and running
``` 

#### Build the Docker image and run from the terminal

```bash
docker build -t nodejs-sdk-example .

docker run --rm -p 3000:3000 nodejs-sdk-example
```

#### Running from IDE (IntelliJ or WebStorm)

1. Go to Run → Edit Configurations.
2. Click Add New → From Dockerfile.
3. Enter a name for the Docker image (e.g., nodejs-sdk-example).
4. Go to Modify Run Options and enable Bind Ports.
5. Go to Browse to open the port mapping dialog and click the + button to add a port mapping:
    - Host port: 3000
    - Container port: 3000
6. Save the configuration.
7. Run the configuration in IDE

After startup, the backend will be available on the http://localhost:3000.