<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota dos Alunos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">
    <div class="container mt-5">
        <h1 class="text-center text-danger font-weight-bold">Cadastro de Alunos</h1>

        <form method="post" class="mt-4">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <div class="form-group">
                    <label for="nome<?php echo $i; ?>" class="text-warning font-weight-bold">Nome do Aluno <?php echo $i; ?>:</label>
                    <input type="text" class="form-control bg-secondary text-light border-warning" name="nome[]" required>
                </div>
                <div class="form-group">
                    <label for="nota<?php echo $i; ?>" class="text-warning font-weight-bold">Nota do Aluno <?php echo $i; ?>:</label>
                    <input type="number" class="form-control bg-secondary text-light border-warning" name="nota[]" step="0.01" min="0" max="10" required>
                </div>
            <?php endfor; ?>
            <button type="submit" class="btn btn-danger btn-block font-weight-bold">Enviar</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="mt-4 p-4 bg-secondary rounded text-light">
                <h2 class="text-warning font-weight-bold">Resultados:</h2>
                <?php
                $nomes = $_POST['nome'];
                $notas = $_POST['nota'];
                $somaNotas = 0;
                $maiorNota = 0;
                $nomeMaiorNota = '';

                for ($i = 0; $i < 10; $i++) {
                    $somaNotas += (float)$notas[$i];
                    if ((float)$notas[$i] > $maiorNota) {
                        $maiorNota = (float)$notas[$i];
                        $nomeMaiorNota = $nomes[$i];
                    }
                }

                $media = $somaNotas / 10;

                echo "<p>Média da classe: <strong>" . number_format($media, 2, ',', '.') . "</strong></p>";
                echo "<p>Aluno com maior nota: <strong>$nomeMaiorNota</strong> (Nota: " . number_format($maiorNota, 2, ',', '.') . ")</p>";
                ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
