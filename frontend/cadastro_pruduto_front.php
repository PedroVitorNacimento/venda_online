<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro de Produto</title>
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
        <!-- Toggle Button -->
        <button onclick="toggleSidebar()" class="absolute top-4 right-4 text-white focus:outline-none">
            <i class="lucide-menu"></i>
        </button>

        <h2 class="text-xl font-bold mb-8 text-center sidebar-label">Painel</h2>

        <nav class="space-y-4 flex-1">
            <a href="#" class="flex items-center gap-3 px-4 py-2 bg-blue-700 rounded hover:bg-blue-600">
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
            <a href="http://localhost/venda_online/backend/logout.php" class="flex items-center gap-3 px-4 py-2 hover:bg-red-600 rounded">
                <i class="lucide-log-out"></i>
                <span class="sidebar-label">Sair</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center p-6">
        <form action="../backend/cadastro_produto_back.php" method="POST" class="w-full max-w-xl bg-white p-8 rounded-2xl shadow space-y-6">
            <h1 class="text-2xl font-bold text-blue-700 text-center mb-4">Cadastro de Produto</h1>

            <div>
                <label for="nome" class="block text-gray-700 font-medium mb-1">Nome do Produto</label>
                <input
                    type="text"
                    id="nome"
                    name="nome_produto"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="nome" class="block text-gray-700 font-medium mb-1">Categoria</label>
                <input
                    type="text"
                    id="nome"
                    name="categoria"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="descricao" class="block text-gray-700 font-medium mb-1">Descrição</label>
                <textarea
                    id="descricao"
                    name="descricao"
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label for="preco" class="block text-gray-700 font-medium mb-1">Preço</label>
                <input
                    type="number"
                    id="preco"
                    name="preco"
                    step="0.01"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="quantidade" class="block text-gray-700 font-medium mb-1">Quantidade em Estoque</label>
                <input
                    type="number"
                    id="quantidade"
                    name="quantidade"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-xl font-semibold hover:bg-blue-700 transition duration-200">
                Cadastrar Produto
            </button>
        </form>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const labels = document.querySelectorAll(".sidebar-label");

            // Alterna entre w-64 e w-20
            if (sidebar.classList.contains("w-64")) {
                sidebar.classList.remove("w-64");
                sidebar.classList.add("w-20");
            } else {
                sidebar.classList.remove("w-20");
                sidebar.classList.add("w-64");
            }

            // Oculta ou exibe os textos
            labels.forEach(label => {
                label.classList.toggle("hidden");
            });
        }

        lucide.createIcons();
    </script>
</body>

</html>