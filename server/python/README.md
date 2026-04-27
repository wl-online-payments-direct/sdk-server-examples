# Online payments Python3 SDK Example

This example app illustrates the use of the Online Payments Python3 SDK and the services provided by the Online Payments platform.

## Recommended Development Environment

- PyCharm (recommended) or VS Code

## How To Run

### Running locally:

```markdown
Prerequisites:
- Python 3.11+
- [Git](https://git-scm.com/)
``` 

#### Configuration (.env)

Before running the backend, you must configure the required credentials in a `.env` file.  
Update `MERCHANT_ID`, `API_KEY_ID`, `API_SECRET_KEY` and `API_ENDPOINT` with valid values for your environment.

#### Install dependencies
```bash
pip install -r requirements.txt
```

#### Running the backend
```bash
uvicorn main:app --host 0.0.0.0 --port 3000
```

After startup, the backend will be available on `http://localhost:3000`.

#### Running the backend through IDE (PyCharm)

Running the backend in PyCharm:
1. Open PyCharm.
2. Go to: **File → Open…** and select the `server/python` directory.
3. PyCharm will load the project.
4. Set up a run configuration: **Run → Edit Configurations → + → Python**.
5. Set the module to `uvicorn` and parameters to `main:app --host 0.0.0.0 --port 3000`.
6. Click **Run**.

After startup, the backend will be available on `http://localhost:3000`.

### Running on Docker

```markdown
Prerequisites:
- Docker installed and running
```

#### Build the Docker image and run from the terminal

```bash
docker build -t python3-sdk-example .

docker run -p 3000:3000 --env-file .env -v "${PWD}:/app" python3-sdk-example
```

#### Running from IDE (PyCharm)

1. Open PyCharm.
2. Go to Run → Edit Configurations.
3. Click Add New → From Docker image.
4. Enter a name for the Docker image (e.g., python3-sdk-example:latest).
5. Go to Modify Run Options and enable Bind Ports.
6. Go to Browse to open the port mapping dialog and click the + button to add a port mapping:
   - Host port: 3000
   - Container port: 3000
7. Save the configuration.
8. Run the configuration in PyCharm.

After startup, the backend will be available on the http://localhost:3000.