from flask import Flask
from flask import render_template
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

@app.route("/round")
def helloJinja():
    
    entity1 = 17.002
    entity2 = 1
    entity3 = 17.001
    resultado = entity1 + entity2 - entity3
    
    return render_template(
        'round.html',
        entity1=entity1,
        entity2=entity2,
        entity3=entity3,
        resultado=resultado
    )
