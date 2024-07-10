import os
import json

def read_config():
    env = os.getenv('PYTHON_ENV', 'local')
    with open(f'configuration/config.{env}.json') as json_file:
        config = json.load(json_file)
    return config