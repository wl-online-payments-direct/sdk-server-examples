# Online payments Ruby SDK Example

## Recommended Development Environment
- Ruby Mine

## How to run

### Configuration (.env)
Before running the backend, you must create `ruby/.env` file and configure the required credentials.  
You can use `.env.example` as a template.
Update `CONFIG_FILE`, `MERCHANT_ID`, `API_KEY` and `API_SECRET` with valid values for your environment.

### Running locally:

```markdown
Prerequisites:
- Ruby 3.3 or higher
- Bundler installed (`gem install bundler`)
``` 

#### Install dependencies
```bash
bundle install
```

Run the application:
```bash
bundle exec rails server -p 3000
```

After startup, the backend will be available at http://localhost:3000.

**Troubleshooting:** If you encounter dependency or gem conflicts, clear the local vendor cache and reinstall:
```bash
# CMD
rd /s /q vendor && bundle install

# PowerShell
Remove-Item -Recurse -Force .\vendor; bundle install
```

### Running on Docker:

```markdown
Prerequisites:
- Docker installed and running
```

#### Build the Docker image
```bash
docker build -t ruby-sdk-example .
```

#### Run from the terminal
```bash
docker run -p 3000:3000 ruby-sdk-example
```

#### Running from IDE (RubyMine)

1. Go to **Run → Edit Configurations**.
2. Click **Add New → From Dockerfile**.
3. Enter a name for the Docker image (e.g., `ruby-sdk-example`).
4. Go to **Modify Run Options** and enable **Bind Ports**.
5. Add port mappings: **Host port: 3000 → Container port: 3000**
6. Save the configuration.
7. Run the configuration in RubyMine.

After startup, the backend will be available on the http://localhost:3000.