<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.html");
    exit;
}

require_once "../data_base/conexao_db.php";

$query = "SELECT * FROM produtos";
$stmt = $conexao->prepare($query);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Estoque</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .transition-width {
            transition: width 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside id="sidebar" class="bg-blue-800 text-white h-full transition-width w-64 p-4 relative flex flex-col">
        <button onclick="toggleSidebar()" class="absolute top-4 right-4 text-white focus:outline-none">
            <i class="lucide-menu"></i>
        </button>

        <h2 class="text-xl font-bold mb-8 text-center sidebar-label">Painel</h2>

        <nav class="space-y-4 flex-1">
            <a href="../frontend/cadastro_pruduto_front.php" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-600 rounded">
                <i class="lucide-package"></i>
                <span class="sidebar-label">Cadastro de Produto</span>
            </a>
            <a href="cadastro_venda_front.php" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-600 rounded">
                <i class="lucide-shopping-cart"></i>
                <span class="sidebar-label">Cadastrar Vendas</span>
            </a>
            <a href="visualizar_vendas.php" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-600 rounded">
                <i class="lucide-list"></i>
                <span class="sidebar-label">Visualizar Vendas</span>
            </a>
            <a href="estoque_loja_front.php" class="flex items-center gap-3 px-4 py-2 bg-blue-700 rounded">
                <i class="lucide-list"></i>
                <span class="sidebar-label">Estoque</span>
            </a>
            <a href="../backend/logout.php" class="flex items-center gap-3 px-4 py-2 hover:bg-red-600 rounded">
                <i class="lucide-log-out"></i>
                <span class="sidebar-label">Sair</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6">
        <h1 class="text-2xl font-bold text-blue-700 mb-6 text-center">Estoque de Produtos</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-xl shadow">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Nome do Produto</th>
                        <th class="py-3 px-4 text-left">Quantidade</th>
                        <th class="py-3 px-4 text-left">Preço Unidade</th>
                        <th class="py-3 px-4 text-left">Categoria</th>
                        <th class="py-3 px-4 text-left">Descrição</th>
                        <th class="pu-3 px-4 text-left">Alterar produto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4"><?= $produto['id_produto'] ?></td>
                            <td class="py-3 px-4"><?= htmlspecialchars($produto['nome_produto']) ?></td>
                            <td class="py-3 px-4"><?= $produto['quantidade'] ?></td>
                            <td class="py-3 px-4"><?= $produto['categoria'] ?></td>
                            <td class="py-3 px-4">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                            <td class="py-3 px-4"><?= $produto['desccricao'] ?></td>
                            <td class="py-3 px-4">
                                <button
                                    onclick='abrirModal(<?= json_encode($produto) ?>)'
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-3 py-1 rounded">
                                    Alterar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Modal de Edição -->
            <div id="modalEditar" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md">
                    <h2 class="text-xl font-bold mb-4 text-blue-700">Alterar Produto</h2>
                    <form action="../backend/alterar_produto_back.php" method="POST" class="space-y-4">
                        <input type="hidden" id="id_produto" name="id_produto">

                        <div>
                            <label class="block font-medium">Nome</label>
                            <input type="text" id="nome_produto" name="nome_produto" required
                                class="w-full border border-gray-300 rounded px-3 py-2" />
                        </div>

                        <div>
                            <label class="block font-medium">Descrição</label>
                            <input type="text" id="descricao" name="descricao" required
                                class="w-full border border-gray-300 rounded px-3 py-2" />
                        </div>

                        <div>
                            <label class="block font-medium">Preço</label>
                            <input type="number" step="0.01" id="preco" name="preco" required
                                class="w-full border border-gray-300 rounded px-3 py-2" />
                        </div>

                        <div>
                            <label class="block font-medium">Categoria</label>
                            <input type="text" step="0.01" id="categoria" name="categoria" required
                                class="w-full border border-gray-300 rounded px-3 py-2" />
                        </div>

                        <div>
                            <label class="block font-medium">Quantidade</label>
                            <input type="number" id="quantidade" name="quantidade" required
                                class="w-full border border-gray-300 rounded px-3 py-2" />
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="fecharModal()"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</button>
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
    <script>
        function abrirModal(produto) {

            document.getElementById("id_produto").value = produto.id_produto;
            document.getElementById("nome_produto").value = produto.nome_produto;
            document.getElementById("descricao").value = produto.desccricao || "";
            document.getElementById("preco").value = produto.preco;
            document.getElementById("categoria").value = produto.categoria;
            document.getElementById("quantidade").value = produto.quantidade;
            document.getElementById("modalEditar").classList.remove("hidden");
        }

        function fecharModal() {
            document.getElementById("modalEditar").classList.add("hidden");
        }

        lucide.createIcons();
    </script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const labels = document.querySelectorAll(".sidebar-label");

            if (sidebar.classList.contains("w-64")) {
                sidebar.classList.remove("w-64");
                sidebar.classList.add("w-20");
            } else {
                sidebar.classList.remove("w-20");
                sidebar.classList.add("w-64");
            }

            labels.forEach(label => {
                label.classList.toggle("hidden");
            });
        }

        lucide.createIcons();
    </script>
</body>

</html>