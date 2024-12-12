<?php
session_start();

// Verificar que el test ha sido completado
if (!isset($_SESSION['testSeleccionado']) || !isset($_SESSION['respuestas'])) {
    echo "No se ha completado ningún test. Por favor, realiza un test.";
    exit;
}

$testSeleccionado = $_SESSION['testSeleccionado'];
$respuestas = $_SESSION['respuestas'];

// Calcular el puntaje total
$puntajeTotal = array_sum($respuestas);

// Recomendaciones por test y rango de puntaje
$recomendaciones = [
    'psicologia' => [
        'bajo' => "Parece que estás enfrentando algunos desafíos emocionales. Considera buscar apoyo en un profesional o hablar con alguien de confianza. Es importante cuidar tu bienestar emocional.",
        'medio' => "Tienes un buen manejo emocional, pero podrías trabajar en fortalecer algunos aspectos, como expresar tus emociones o manejar el estrés de forma más efectiva.",
        'alto' => "¡Enhorabuena! Pareces tener una gran salud emocional. Sigue cuidándote y reforzando esos hábitos positivos."
    ],
    'deporte' => [
        'bajo' => "Es posible que no estés dedicando suficiente tiempo a la actividad física. Intenta incorporar ejercicios simples a tu rutina diaria para mejorar tu salud y energía.",
        'medio' => "Estás en el camino correcto con tu actividad física. Considera ser más constante o explorar nuevas formas de ejercicio que te motiven.",
        'alto' => "¡Genial! Tienes una excelente rutina de actividad física. Mantén esos buenos hábitos y sigue disfrutando del deporte."
    ],
    'alimentacion' => [
        'bajo' => "Tu alimentación podría necesitar algunos ajustes. Trata de incluir más frutas y verduras, y reduce los alimentos procesados para mejorar tu salud general.",
        'medio' => "Tu alimentación está bastante equilibrada, pero aún hay espacio para mejoras. Asegúrate de mantener una dieta variada y controlar las porciones.",
        'alto' => "¡Fantástico! Tienes muy buenos hábitos alimenticios. Sigue así y continúa cuidando tu bienestar con una dieta equilibrada."
    ]
];

// Determinar la categoría de puntaje
if ($puntajeTotal <= 20) {
    $categoria = 'bajo';
} elseif ($puntajeTotal <= 40) {
    $categoria = 'medio';
} else {
    $categoria = 'alto';
}

// Obtener la recomendación basada en el test y el puntaje
$mensajeFinal = $recomendaciones[$testSeleccionado][$categoria];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>¡Test completado!</h1>
    <p>Gracias por completar el test de <strong><?php echo ucfirst($testSeleccionado); ?></strong>.</p>
    <p><strong>Tu puntuación total es: <?php echo $puntajeTotal; ?></strong></p>
    <p><?php echo $mensajeFinal; ?></p>

    <div class="acciones">
        <!-- Botón para volver al inicio -->
        <form action="reset_test.php" method="POST" style="display:inline;">
            <button type="submit" class="btn" style="background-color: red; color: white; text-decoration: none;">Volver al inicio</button>
        </form>
    </div>
</div>
</body>
</html>