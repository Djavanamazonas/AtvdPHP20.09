<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">
    <div class="container mt-5 p-4 bg-secondary rounded shadow-lg">
        <h1 class="text-center text-danger font-weight-bold mb-4">Cadastro de Produtos</h1>

        <form method="post">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="form-group">
                    <label for="produto<?php echo $i; ?>" class="text-warning font-weight-bold">Produto <?php echo $i; ?>:</label>
                    <input type="text" class="form-control bg-dark text-light border-warning" name="nome[]" required>
                </div>
                <div class="form-group">
                    <label for="preco<?php echo $i; ?>" class="text-warning font-weight-bold">Preço:</label>
                    <input type="number" class="form-control bg-dark text-light border-warning" name="preco[]" step="0.01" required>
                </div>
            <?php endfor; ?>
            <button type="submit" class="btn btn-danger btn-block font-weight-bold">Enviar</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="mt-4 p-4 bg-dark rounded text-light border-warning shadow">
                <h2 class="text-warning font-weight-bold">Resultados:</h2>
                <?php
                $nomes = $_POST['nome'];
                $precos = $_POST['preco'];
                $produtos = [];

                for ($i = 0; $i < 5; $i++) {
                    $produtos[] = ['nome' => $nomes[$i], 'preco' => (float)$precos[$i]];
                }

                $qntInferiorA50 = array_reduce($produtos, function ($count, $produto) {
                    return $count + ($produto['preco'] < 50 ? 1 : 0);
                }, 0);

                $produtosEntre50e100 = array_filter($produtos, function ($produto) {
                    return $produto['preco'] >= 50 && $produto['preco'] < 100;
                });
                $nomesEntre50e100 = array_column($produtosEntre50e100, 'nome');

                $precosAcima100 = array_filter($produtos, function ($produto) {
                    return $produto['preco'] > 100;
                });
                $mediaAcima100 = count($precosAcima100) > 0 ? array_sum(array_column($precosAcima100, 'preco')) / count($precosAcima100) : 0;

                echo "<p>A quantidade de produtos com preço inferior a R$50,00: <strong>$qntInferiorA50</strong></p>";
                echo "<p>Produtos com preço entre R$50,00 e R$100,00: <strong>" . implode(", ", $nomesEntre50e100) . "</strong></p>";
                if ($mediaAcima100 > 0) {
                    echo "<p>A média dos preços dos produtos com preço superior a R$100,00: <strong>R$" . number_format($mediaAcima100, 2, ',', '.') . "</strong></p>";
                } else {
                    echo "<p>Não há produtos com preço superior a R$100,00.</p>";
                }
                ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
