# Online payments PHP SDK Example

This example app illustrates the use of the Online Payments PHP SDK and the services provided by the Online Payments platform.

## Recommended Development Environment

- PHP Storm

## How To Run

### Configuration (.env)
Before running the backend, you must create `php/.env` file and configure the required credentials.  
You can use `.env.example` as a template.
Update `merchantId`, `apiKey`, `apiSecret`, `apiEndpoint` and `allowedOrigin` with valid values for your environment.

### Running locally:

```markdown
Prerequisites:
- PHP 8.2+
- [Git](https://git-scm.com/)
``` 

#### Clean build (recommended)
Run these commands before starting the backend:

```bash
#in cmd
rm -rf vendor

composer clear-cache

composer install --no-interaction --prefer-dist --optimize-autoloader
```

```bash
#in powershell
Remove-Item -Recurse -Force .\vendor

composer clear-cache

composer install --no-interaction --prefer-dist --optimize-autoloader
```

#### Running the backend through the terminal
1. Open your IDE (PhpStorm) and open the project folder server/php.
2. In the IDE terminal run: `php -S localhost:3000 -t public`

#### Running the backend through the IDE
1. Go to Run → Edit Configurations → + → PHP Built-in Web Server.
2. For the custom working directory, select `server\php\public`.
3. Set port to `3000`.
4. Rename the configuration (optional) and save the configuration.
5. Click the run button and the backend will start.

### Running on Docker:

```markdown
Prerequisites:
- Docker installed and running
``` 

#### Clean build (recommended)
Run these commands before starting the backend:

```bash
#in cmd
rm -rf vendor

docker run --rm -v "${PWD}:/app" -w /app -v composer-cache:/tmp/cache -e COMPOSER_CACHE_DIR=/tmp/cache composer:2 install --no-interaction --prefer-dist --optimize-autoloader
```

```bash
#in powershell
Remove-Item -Recurse -Force .\vendor

docker run --rm -v "${PWD}:/app" -w /app -v composer-cache:/tmp/cache -e COMPOSER_CACHE_DIR=/tmp/cache composer:2 install --no-interaction --prefer-dist --optimize-autoloader
```

#### Build the Docker image and run from the terminal
```bash
docker build -t php-sdk-example:8.2 .

docker run --rm -v "${PWD}:/app" -p 3000:3000 php-sdk-example:8.2
```

#### Running from IDE (PhpStorm)

1. Go to Run → Edit Configurations.
2. Click Add New → From Dockerfile.
3. Enter a name for the Docker image (e.g., php-sdk-example:8.2).
4. Go to Modify Run Options and enable Bind Ports.
5. Go to Browse to open the port mapping dialog and click the + button to add a port mapping:
   - Host port: 3000
   - Container port: 3000
6. Save the configuration.
7. Run the configuration in PhpStorm

After startup, the backend will be available on the http://localhost:3000.