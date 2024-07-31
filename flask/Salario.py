from random import random
import re

class Salario:
    def __init__(self):
        salario_minimo = 1400
        self.valor = round(
            (random() * (20000 - salario_minimo)) + salario_minimo,
            2
            )
        
    
    def getSalario(self) -> float:
        return self.valor
        