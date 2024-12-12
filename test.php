<?php
// Iniciar la sesión para almacenar las respuestas
session_start();

// Obtener el test seleccionado
if (isset($_GET['test'])) {
    $testSeleccionado = $_GET['test'];
    $_SESSION['testSeleccionado'] = $testSeleccionado;
} else {
    $testSeleccionado = isset($_SESSION['testSeleccionado']) ? $_SESSION['testSeleccionado'] : null;
}

// Redirigir al índice si no hay test seleccionado
if (!$testSeleccionado) {
    header("Location: index.html");
    exit;
}

// Definir preguntas y respuestas según el test
$tests = [
    'psicologia' => [
        'preguntas' => [
            '¿Con qué frecuencia sientes que puedes controlar el estrés en tu vida?',
            'Cuando enfrentas un problema difícil, ¿cómo sueles actuar?',
            '¿Cómo describirías tu autoestima?',
            '¿Qué tan bien manejas los conflictos con otras personas?',
            '¿Te sientes cómodo expresando tus emociones?',
            '¿Con qué frecuencia tienes pensamientos negativos sobre ti mismo?',
            '¿Sueles marcarte objetivos claros en la vida?',
            '¿Cómo manejas los cambios inesperados en tu vida?',
            '¿Qué tan satisfecho estás con tu vida social?',
            '¿Cuánto tiempo dedicas al autocuidado y bienestar personal?'
        ],
        'opciones' => [
            ['Siempre', 'Casi siempre', 'A veces', 'Rara vez', 'Nunca'],
            ['Me mantengo calmado y busco soluciones', 'Pido ayuda', 'Reflexiono', 'Me bloqueo', 'Evito enfrentarlo'],
            ['Muy alta', 'Alta', 'Moderada', 'Baja', 'Muy baja'],
            ['Muy bien', 'Bien', 'Depende', 'Con dificultad', 'Muy mal'],
            ['Sí, siempre', 'Mayormente sí', 'Depende', 'No mucho', 'Nunca'],
            ['Nunca', 'Rara vez', 'A veces', 'Frecuentemente', 'Siempre'],
            ['Siempre', 'Casi siempre', 'A veces', 'Rara vez', 'Nunca'],
            ['Fácilmente', 'Con esfuerzo', 'Me cuesta', 'Difícil', 'Evito cambios'],
            ['Muy satisfecho', 'Satisfecho', 'Neutral', 'Insatisfecho', 'Muy insatisfecho'],
            ['Mucho tiempo', 'Bastante tiempo', 'Algo de tiempo', 'Poco tiempo', 'Ningún tiempo']
        ]
    ],
    'deporte' => [
        'preguntas' => [
            '¿Con qué frecuencia haces ejercicio físico?',
            '¿Qué tipo de ejercicio prefieres?',
            '¿Cuánto tiempo dedicas al ejercicio cuando lo haces?',
            '¿Qué tan importante consideras la actividad física en tu vida?',
            '¿Cómo te sientes después de hacer ejercicio?',
            '¿Con qué frecuencia te lesionas al practicar deporte?',
            '¿Qué es lo que más te motiva para hacer ejercicio?',
            '¿Te gusta practicar deporte en grupo o en solitario?',
            '¿Qué tan bien manejas la fatiga durante el ejercicio?',
            '¿Incluyes ejercicios de calentamiento y estiramiento en tu rutina?'
        ],
        'opciones' => [
            ['Todos los días', 'Varias veces a la semana', 'Una vez a la semana', 'Una vez al mes', 'Nunca'],
            ['Cardio', 'Fuerza', 'Deporte en equipo', 'Actividades al aire libre', 'No me gusta hacer ejercicio'],
            ['Más de 1 hora', '45 minutos a 1 hora', '30 a 45 minutos', 'Menos de 30 minutos', 'No hago ejercicio'],
            ['Muy importante', 'Importante', 'Moderadamente importante', 'Poco importante', 'Nada importante'],
            ['Energizado', 'Relajado', 'Neutral', 'Cansado', 'Agotado'],
            ['Nunca', 'Rara vez', 'A veces', 'Frecuentemente', 'Siempre'],
            ['Mejorar mi salud', 'Sentirme bien', 'Alcanzar objetivos', 'La presión social', 'No tengo motivación'],
            ['Siempre en grupo', 'Prefiero en grupo', 'Indiferente', 'Prefiero en solitario', 'Siempre en solitario'],
            ['Muy bien', 'Bien', 'Normal', 'Mal', 'Muy mal'],
            ['Siempre', 'Casi siempre', 'A veces', 'Rara vez', 'Nunca']
        ]
    ],
    'alimentacion' => [
        'preguntas' => [
            '¿Con qué frecuencia comes frutas y verduras?',
            '¿Qué tipo de bebidas consumes con más frecuencia?',
            '¿Cuántas comidas haces al día?',
            '¿Con qué frecuencia comes alimentos procesados?',
            '¿Qué tan balanceada consideras tu dieta?',
            '¿Qué tanto controlas las porciones que consumes?',
            '¿Sueles comer por ansiedad o estrés?',
            '¿Qué tan importante consideras la alimentación en tu vida?',
            '¿Cuánto tiempo dedicas a preparar tus alimentos?',
            '¿Qué tan satisfecho estás con tus hábitos alimenticios?'
        ],
        'opciones' => [
            ['Todos los días', 'Varias veces a la semana', 'Una vez a la semana', 'Rara vez', 'Nunca'],
            ['Agua', 'Jugos naturales', 'Bebidas azucaradas', 'Café o té', 'Bebidas alcohólicas'],
            ['Más de cinco', 'Cuatro o cinco', 'Tres', 'Dos', 'Una o ninguna'],
            ['Nunca', 'Rara vez', 'A veces', 'Frecuentemente', 'Siempre'],
            ['Muy balanceada', 'Moderadamente balanceada', 'Poco balanceada', 'Desequilibrada', 'No tengo dieta balanceada'],
            ['Siempre', 'Frecuentemente', 'A veces', 'Rara vez', 'Nunca'],
            ['Nunca', 'Rara vez', 'A veces', 'Frecuentemente', 'Siempre'],
            ['Muy importante', 'Importante', 'Moderadamente importante', 'Poco importante', 'Nada importante'],
            ['Más de 1 hora', 'Entre 30 minutos y 1 hora', 'Menos de 30 minutos', 'Depende del día', 'No preparo mis alimentos'],
            ['Muy satisfecho', 'Satisfecho', 'Neutral', 'Insatisfecho', 'Muy insatisfecho']
        ]
    ]
];

// Configurar preguntas y opciones
$preguntas = $tests[$testSeleccionado]['preguntas'];
$opciones = $tests[$testSeleccionado]['opciones'];

// Definir valores para cada respuesta (mejor = 5, peor = 1)
$valoresRespuestas = [5, 4, 3, 2, 1];

// Obtener la pregunta actual o inicializarla en 1
$preguntaActual = isset($_POST['preguntaActual']) ? (int)$_POST['preguntaActual'] : 1;
$puntajeTotal = isset($_POST['puntajeTotal']) ? (int)$_POST['puntajeTotal'] : 0;

// Lógica de navegación y puntuación
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['anterior'])) {
        $preguntaActual--;
    } elseif (isset($_POST['siguiente']) || isset($_POST['finalizar'])) {
        if (!isset($_POST['respuesta'])) {
            echo "<script>alert('Debes seleccionar una respuesta para continuar.');</script>";
        } else {
            $respuestaIndice = (int)$_POST['respuesta'] - 1; // Índice basado en la opción seleccionada
            $puntajeTotal += $valoresRespuestas[$respuestaIndice]; // Sumar el valor correspondiente
            $_SESSION['respuestas'][$preguntaActual] = $valoresRespuestas[$respuestaIndice]; // Guardar el valor en sesión
            if (isset($_POST['siguiente']) && $preguntaActual < 10) {
                $preguntaActual++;
            } elseif (isset($_POST['finalizar'])) {
                $_SESSION['puntajeTotal'] = $puntajeTotal; // Guardar el puntaje total
                header("Location: confirmacion.php");
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test <?php echo ucfirst($testSeleccionado); ?> - Pregunta <?php echo $preguntaActual; ?></title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
    <h1>Test de <?php echo ucfirst($testSeleccionado); ?> - Pregunta <?php echo $preguntaActual; ?></h1>
    <p><?php echo $preguntas[$preguntaActual - 1]; ?></p>

    <form action="test.php" method="POST">
        <input type="hidden" name="preguntaActual" value="<?php echo $preguntaActual; ?>">
        <input type="hidden" name="puntajeTotal" value="<?php echo $puntajeTotal; ?>">

        <!-- Opciones de respuesta -->
        <div class="opciones">
            <?php foreach ($opciones[$preguntaActual - 1] as $indice => $texto): ?>
                <label>
                    <input type="radio" name="respuesta" value="<?php echo $indice + 1; ?>">
                    <?php echo htmlspecialchars($texto); ?>
                </label><br>
            <?php endforeach; ?>
        </div>

        <!-- Navegación entre preguntas -->
        <div class="navegacion">
            <?php if ($preguntaActual > 1): ?>
                <button type="submit" name="anterior" class="btn">⬅ Anterior</button>
            <?php endif; ?>

            <?php if ($preguntaActual < 10): ?>
                <button type="submit" name="siguiente" class="btn">Siguiente ➡</button>
            <?php else: ?>
                <button type="submit" name="finalizar" class="btn">Finalizar</button>
            <?php endif; ?>

            <a href="index.html" class="btn" style="background-color: red; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px;">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>