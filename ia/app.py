# python/app.py
from flask import Flask, jsonify, request
import random

app = Flask(__name__)

# Configuración de la conexión a la base de datos
db_config = {
    'host': 'db',  # El nombre del servicio de Docker
    'user': 'root',
    'password': 'root',
    'database': 'db_restpro'
}

@app.route('/api/consulta', methods=['GET'])
def get_productos():
    try:
        # Conectar a la base de datos
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor()
        cursor.execute("SELECT * FROM areas")
        rows = cursor.fetchall()

        # Convertir los datos en un diccionario
        data = []
        for row in rows:
            data.append({'id': row[0], 'nombre': row[1], 'descripcion': row[2]})

        return jsonify(data)
    except mysql.connector.Error as err:
        return jsonify({"error": str(err)}), 500
    finally:
        cursor.close()
        conn.close()

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
    try:
        data = request.json  # Obtener los datos JSON enviados
        dia = data.get('dia', 0)
        personas = data.get('personas', 0)
        hora = data.get('hora', 0)
        minutos = data.get('minutos', 0)
        
        if personas == 1:
            personas += 1
        elif (personas % 2 != 0):
            personas -= 1
        
        # Conectar a la base de datos
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor()
        cursor.execute(f"SELECT * FROM ia WHERE personas = {personas} AND hora = {hora} AND minutos = {minutos}")
        rows = cursor.fetchall()
        
        
        # Convertir los datos en un diccionario
        data = []
        for row in rows:
            data.append({'salida': row[4]})
        data = random.choice(data)
        return jsonify({"resultado": data})
    except mysql.connector.Error as err:
        return jsonify({"error": str(err)}), 500
    finally:
        cursor.close()
        conn.close()

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
