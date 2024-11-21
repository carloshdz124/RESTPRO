<?php
function predict_IA($jsonData)
{
    // Decodificar el JSON a un array asociativo 
    //$data = json_decode($jsonDatos, true);

    // Convertir los datos a formato JSON
    //$jsonData = json_encode($data);

    // URL de la API de FastAPI
    $apiUrl = "http://fastapi-api:8000/predict";

    // Inicializar cURL
    $ch = curl_init($apiUrl);

    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Obtener respuesta como string
    curl_setopt($ch, CURLOPT_POST, true);          // Método POST
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",          // Especificar formato JSON
        "Content-Length: " . strlen($jsonData)
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Enviar datos JSON

    // Ejecutar la solicitud
    $response = curl_exec($ch);

    // Manejar errores de cURL
    if (curl_errno($ch)) {
        echo "Error en cURL: " . curl_error($ch);
        curl_close($ch);
        exit;
    }

    // Cerrar cURL
    curl_close($ch);

    // Decodificar y mostrar la respuesta
    $responseData = json_decode($response, true);
    return ($responseData);
}
