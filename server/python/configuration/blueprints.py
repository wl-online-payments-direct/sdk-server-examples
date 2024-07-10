from flask import Blueprint # type: ignore
import os

def create_static_blueprint():
    return Blueprint('static', __name__, static_url_path='', 
                     static_folder=os.path.join(
                         os.path.dirname(
                             os.path.dirname(
                                 os.path.dirname(
                                     os.path.dirname(os.path.abspath(__file__))
                                     )
                                )                         
                            ), 'client'))