from fastapi import FastAPI
import keras
import tensorflow as tf
from tensorflow.keras.models import load_model
from pydantic import BaseModel, validator
import numpy as np

class prediccion(BaseModel):
    dia : float
    no_personas : float
    hora : float
    minutos : float


@keras.saving.register_keras_serializable()
def weighted_mse_loss(y_true, y_pred):
    # Assume y_true and y_pred are structured as [hours, minutes]
    hours_true, minutes_true = y_true[:, 0], y_true[:, 1]
    hours_pred, minutes_pred = y_pred[:, 0], y_pred[:, 1]

    # Weigh hours more heavily, e.g., by a factor of 10
    hour_loss = tf.square(hours_true - hours_pred) * 10
    minute_loss = tf.square(minutes_true - minutes_pred)

    return tf.reduce_mean(hour_loss + minute_loss)

@keras.saving.register_keras_serializable()
def average_hour_difference(y_true, y_pred):
    # Assume y_true and y_pred are structured as [hours, minutes]
    hours_true = tf.cast(y_true[:, 0], tf.float32)  # Cast to float32 if not already
    hours_pred = tf.cast(y_pred[:, 0], tf.float32)

    # Calculate the absolute difference between actual and predicted hours
    hour_difference = tf.abs(hours_true - hours_pred)

    # Calculate the average difference

    return h

model = load_model("app/modelo.keras")

app = FastAPI()

@app.get("/")
def read_root():
    return {"message": "Hello, FastAPI!"}

@app.get("/process-data")
def process_data(value: int):
    # Procesa el dato recibido
    result = value * 3
    return {"input": value, "output": result}


@app.get("/predict")
def process_data(prediccion: prediccion):

    input = np.zeros((1,4))
    input[0,0] = prediccion.dia
    input[0,1] = prediccion.no_personas
    input[0,2] = prediccion.hora
    input[0,3] = prediccion.minutos

    result = model.predict(input)
    print(round(result[0,0]),round(result[0,1]))
    
    return {"Hora:":round(result[0,0]),"Minuto:":round(result[0,1])}
