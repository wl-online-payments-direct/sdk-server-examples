# Server SDKs Example

This is a monorepo that includes examples from the Online Payments Server SDKs that illustrates the usage of the Online Payments platform. The main goal is to bring the Server SDKs closer to the consumers by simply providing examples for their usage in every supported language.

The project is structured in a way where the client and server concerns are clearly divided.

    server-sdk-examples/
      server/
        dotnet/   - .NET backend implementation
        java/     - Java backend implementation
        php/      - PHP backend implementation
        ...       - Additional backends (future)
      client/     - JavaScript frontend

### Available scenarios

Within the scope of the example applications, the following scenarios are available

- Create Hosted Checkout Session
- Create Payment Link
- Create Payment using Hosted Tokenization
- Create Server-to-Server Card Payment
- Create Server-to-Server Direct Debit Payment
- Execute Additional Action on Payment (Cancel, Capture, Refund)

## 1. Server (Backend)

The `server` directory contains all backend implementations.  

Examples of server-side implementations of the integration methods supported by the Online Payments platform in the supported languages. 
Please find more information about the specific for every supported language on the links below:

- [.NET backend](./server/dotnet/sdk-dotnet-example/README.md)
- [Java backend](./server/java/README.md)
- [PHP backend](./server/php/README.md)

## 2. Client (Frontend JavaScript Application)

The frontend lives in the `client` folder and is implemented as a standalone React project.

### 2.1 Recommended Development Environment

- JetBrains WebStorm (recommended)

### 2.2 How to Run the Frontend

Prerequisites:
- Node.js (LTS recommended)
- npm installed

Environment setup:
- Copy `.env.example` to `.env`
- Set the desired port inside `.env`. Each of the backend example application is currently run on port `3000`.

Setup (installing dependencies):
If using a terminal from the repository root:
```bash
  cd client
  npm install
```

Running the frontend:
```bash
  npm run start
```

If using WebStorm terminal → run `npm run start` directly.

## 3. Recommended Development Workflow

1. Open backend and frontend in separate IDE instances:
    - Open desired backend application in suggested environment
    - Open `client` in WebStorm

2. Start the backend first

3. Start the frontend

4. The frontend will now communicate with the running backend.
