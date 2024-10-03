# python/app.py
from flask import Flask, jsonify, request

app = Flask(__name__)

@app.route('/api/funcion', methods=['GET'])
def funcion():
    return jsonify({"mensaje": "Hola desde Python y una apiiii"})

@app.route('/api/suma', methods=['POST'])
def suma():
    data = request.json  # Obtener los datos JSON enviados
    num1 = data.get('num1', 0)  # Obtener el primer número
    num2 = data.get('num2', 0)  # Obtener el segundo número
    resultado = num1 + num2  # Realizar la suma
    return jsonify({"resultado": resultado})  # Devolver el resultado

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
