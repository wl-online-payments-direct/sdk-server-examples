from flask import Flask, send_from_directory, request # type: ignore
from configuration.config_reader import read_config
from configuration.blueprints import create_static_blueprint
from hosted_checkout import hosted_checkout_controller
from hosted_tokenization import hosted_tokenization_controller
from payment import create_payment_controller

app = Flask(__name__, static_folder=None)

# Define a new Blueprint for serving static files.
# This will serve files from /monorepo/client
static_blueprint = create_static_blueprint()
app.register_blueprint(static_blueprint)

# setup the config
config = read_config()

# reroute the root to index html
@app.route('/')
def root():
    return send_from_directory(static_blueprint.static_folder, 'index.html')

@app.route("/test")
def hello():
    return config

# Payments
@app.route("/api/createpayment")
def initialize_payment():
    return create_payment_controller.initialize_payment()

@app.route("/api/createpayment/basic", methods=['POST'])
def create_payment():
    data = request.get_json()
    return create_payment_controller.create_payment(data)

@app.route("/api/createpayment/outcome")
def payment_outcome():
    return create_payment_controller.outcome()

# Hosted Checkout
@app.route("/api/hostedcheckout")
def initialize_hosted_checkout():
    return hosted_checkout_controller.initialize_hosted_checkout()

@app.route("/api/hostedcheckout/basic", methods=['POST'])
def create_hosted_checkout():
    data = request.get_json()
    return hosted_checkout_controller.create_hosted_checkout(data)

@app.route("/api/hostedcheckout/outcome")
def hosted_checkout_outcome():
    return hosted_checkout_controller.outcome()

# Hosted Tokenization
@app.route("/api/hostedtokenization")
def initialize_hosted_tokenization():
    return hosted_tokenization_controller.initialize_hosted_tokenization()

@app.route("/api/hostedtokenization/basic", methods=['POST'])
def create_hosted_tokenization():
    data = request.get_json()
    return hosted_tokenization_controller.create_hosted_tokenization(data)

@app.route("/api/hostedtokenization/outcome")
def hosted_tokenization_outcome():
    return hosted_tokenization_controller.outcome()

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True, port=3000)