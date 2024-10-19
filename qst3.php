<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Números</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">
    <div class="container mt-5 p-4 bg-secondary rounded shadow-lg">
        <h1 class="text-center text-danger font-weight-bold mb-4">Análise de Números</h1>

        <form method="post">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <div class="form-group">
                    <label for="numero<?php echo $i; ?>" class="text-warning font-weight-bold">Número <?php echo $i; ?>:</label>
                    <input type="number" class="form-control bg-dark text-light border-warning" name="numeros[]" required>
                </div>
            <?php endfor; ?>
            <button type="submit" class="btn btn-danger btn-block font-weight-bold">Enviar</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="mt-4 p-4 bg-dark rounded text-light border-warning shadow">
                <h2 class="text-warning font-weight-bold">Resultados:</h2>
                <?php
                $numeros = $_POST['numeros'];
                $positivos = 0;
                $negativos = 0;
                $pares = 0;
                $impares = 0;

                foreach ($numeros as $numero) {
                    if ($numero >= 0) {
                        $positivos++;
                    } else {
                        $negativos++;
                    }

                    if ($numero % 2 == 0) {
                        $pares++;
                    } else {
                        $impares++;
                    }
                }

                echo "<p>Quantidade de números positivos: <strong>$positivos</strong></p>";
                echo "<p>Quantidade de números negativos: <strong>$negativos</strong></p>";
                echo "<p>Quantidade de números pares: <strong>$pares</strong></p>";
                echo "<p>Quantidade de números ímpares: <strong>$impares</strong></p>";
                ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
