from fastapi import FastAPI

app = FastAPI()

@app.get("/")
def read_root():
    return {"message": "Hello, FastAPI!"}

@app.get("/process-data")
def process_data(value: int):
    # Procesa el dato recibido
    result = value * 2
    return {"input": value, "output": result}
