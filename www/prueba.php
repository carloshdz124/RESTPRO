<h1>HOLA</h1>

<?php
$url = 'http://ia:5000/api/funcion'; // usa el nombre del servicio como host
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo $response. "<br>"; // Muestra la respuesta de Python


// Definir los números que deseas sumar
$num1 = 5;
$num2 = 10;

$url = 'http://ia:5000/api/suma'; // URL de la API de Python
$data = array('num1' => $num1, 'num2' => $num2); // Datos a enviar

$options = array(
    'http' => array(
        'header'  => "Content-Type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data), // Convertir los datos a JSON
    ),
);

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context); // Hacer la solicitud
if ($response === FALSE) { /* Manejar error */ }

$responseData = json_decode($response, true); // Decodificar la respuesta JSON
echo "Resultado de la suma: " . $responseData['resultado']; // Mostrar el resultado
?>

?>
