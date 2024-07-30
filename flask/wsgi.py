from flask import Flask
from flask import request
from numpy import random

app = Flask(__name__)
    
@app.route("/normal")
def normal():
    request_args = request.args
    count_arg = request_args["count"]
    count = int(count_arg)
    
    x = random.normal(loc=10000, scale=4000, size=(1, count))
    
    valores = []
    for valor in x[0]:
        valores.append(valor)

    return valores
