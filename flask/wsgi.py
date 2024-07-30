from flask import Flask
from faker import Faker
from Salario import Salario

app = Flask(__name__)

@app.route("/")
def hello():
    faker = Faker()

    pessoas = []
    for i in range(1, 101):
        salario = Salario()
        
        pessoas.append({
            'nome': faker.name(),
            'salario': salario.getSalario()
        })
    
    return pessoas
