# python/app.py
from flask import Flask, jsonify, request

app = Flask(__name__)

@app.route('/api/funcion', methods=['GET'])
def funcion():
    return jsonify({"mensaje": "Hola desde Python y una aaaaaapiiii tttttttttttttt"})

@app.route('/api/suma', methods=['POST'])
def suma():
    data = request.json
    num1 = data.get('num1', 0)
    num2 = data.get('num2', 0)
    resultado = num1 + num2
    return jsonify({"resultado": resultado})

@app.route('/api/resta', methods=['POST'])
def resta():
    data = request.json
    num1 = data.get('num1', 0)
    num2 = data.get('num2', 0) 
    resultado = num1 - num2
    return jsonify({"resultado": resultado})  # Devolver el resultado

@app.route('/api/ia', methods=['POST'])
def ia():
    data = request.json  # Obtener los datos JSON enviados
    dia = data.get('dia', 0)
    personas = data.get('personas', 0)
    hora = data.get('hora', 0)
    minutos = data.get('minutos', 0)
    resultado = dia * personas - (hora*minutos)
    return jsonify({"resultado": resultado})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
