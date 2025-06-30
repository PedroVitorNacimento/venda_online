<?php
// Inicia a sessão para garantir que apenas usuários logados possam acessar
session_start();

// Verifica se o usuário está logado, se não estiver, redireciona para a tela de login
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.html");
    exit;
}

// Inclui o arquivo de conexão com o banco de dados
require_once "../data_base/conexao_db.php";

// Consulta os produtos disponíveis no estoque (quantidade > 0)
$query = "SELECT * FROM produtos WHERE quantidade > 0";
$stmt = $conexao->prepare($query);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Armazena os produtos em um array associativo
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Venda</title>
    <!-- Importa o Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Importa os ícones do Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100 flex h-screen overflow-hidden">
    <!-- Sidebar com botões de navegação -->
    <aside id="sidebar" class="bg-blue-800 text-white h-full transition-width w-64 p-4 relative flex flex-col">
        <!-- Botão para esconder/mostrar a sidebar -->
        <button onclick="toggleSidebar()" class="absolute top-4 right-4 text-white focus:outline-none">
            <i class="lucide-menu"></i>
        </button>
        <h2 class="text-xl font-bold mb-8 text-center sidebar-label">Painel</h2>
        <nav class="space-y-4 flex-1">
            <!-- Links da sidebar -->
            <a href="cadastro_pruduto_front.php" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-600 rounded">
                <i class="lucide-package"></i><span class="sidebar-label">Cadastro de Produto</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2 bg-blue-700 rounded">
                <i class="lucide-shopping-cart"></i><span class="sidebar-label">Cadastrar Vendas</span>
            </a>
            <a href="visualizar_vendas.php" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-600 rounded">
                <i class="lucide-list"></i><span class="sidebar-label">Visualizar Vendas</span>
            </a>
            <a href="estoque_loja_front.php" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-600 rounded">
                <i class="lucide-list"></i><span class="sidebar-label">Estoque</span>
            </a>
            <a href="../backend/logout.php" class="flex items-center gap-3 px-4 py-2 hover:bg-red-600 rounded">
                <i class="lucide-log-out"></i><span class="sidebar-label">Sair</span>
            </a>
        </nav>
    </aside>

    <!-- Conteúdo principal -->
    <main class="flex-1 overflow-y-auto p-6">
        <h1 class="text-2xl font-bold text-blue-700 mb-6 text-center">Cadastrar Venda</h1>

        <!-- Formulário que envia os dados da venda para o backend -->
        <form action="../backend/cadastrar_venda_back.php" method="POST">
            <table class="min-w-full bg-white rounded-xl shadow">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Produto</th>
                        <th class="py-3 px-4 text-left">Preço Unitário</th>
                        <th class="py-3 px-4 text-left">Estoque</th>
                        <th class="py-3 px-4 text-left">Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Lista todos os produtos disponíveis -->
                    <?php foreach ($produtos as $produto): ?>
                        <tr class="border-b">
                            <td class="py-2 px-4">
                                <?= htmlspecialchars($produto['nome_produto']) ?>
                                <!-- Envia o ID do produto em um campo oculto -->
                                <input type="hidden" name="produtos[]" value="<?= $produto['id_produto'] ?>">
                            </td>
                            <td class="py-2 px-4">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                            <td class="py-2 px-4"><?= $produto['quantidade'] ?></td>
                            <td class="py-2 px-4">
                                <!-- Campo para o usuário digitar a quantidade a ser vendida -->
                                <input type="number" name="quantidades[]" min="0" max="<?= $produto['quantidade'] ?>" value="0"
                                    class="border border-gray-300 rounded px-2 py-1 w-20" onchange="atualizarTotal()">
                                <!-- Campo oculto para armazenar o preço -->
                                <input type="hidden" name="precos[]" value="<?= $produto['preco'] ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Exibe o total da venda -->
            <div class="mt-4 text-right">
                <span class="text-xl font-semibold">Total: R$ </span><span id="totalVenda" class="text-xl font-bold text-blue-700">0,00</span>
            </div>

            <!-- Botão para concluir a venda -->
            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-xl font-semibold hover:bg-blue-700">
                    Concluir Venda
                </button>
            </div>
        </form>
    </main>

    <script>
        // Atualiza o total da venda quando a quantidade muda
        function atualizarTotal() {
            let quantidades = document.querySelectorAll('input[name="quantidades[]"]');
            let precos = document.querySelectorAll('input[name="precos[]"]');
            let total = 0;
            for (let i = 0; i < quantidades.length; i++) {
                let qtd = parseInt(quantidades[i].value) || 0;
                let preco = parseFloat(precos[i].value);
                total += qtd * preco;
            }
            document.getElementById('totalVenda').textContent = total.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
        }

        // Função para esconder/mostrar a sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const labels = document.querySelectorAll(".sidebar-label");
            sidebar.classList.toggle("w-64");
            sidebar.classList.toggle("w-20");
            labels.forEach(label => label.classList.toggle("hidden"));
        }

        // Ativa os ícones
        lucide.createIcons();
    </script>
</body>

</html>