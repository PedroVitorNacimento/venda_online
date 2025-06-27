<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro de Usuário</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form action="../backend/cadastro_usuario_back.php" method="POST" class="w-full max-w-md bg-white p-8 rounded-2xl shadow space-y-6">
        <h1 class="text-2xl font-bold text-blue-700 text-center mb-4">Cadastro de Usuário</h1>

        <div>
            <label for="nome" class="block text-gray-700 font-medium mb-1">Nome</label>
            <input
                type="text"
                id="nome"
                name="nome"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
            <label for="senha" class="block text-gray-700 font-medium mb-1">Senha</label>
            <input
                type="password"
                id="senha"
                name="senha"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
            <label for="confirma_senha" class="block text-gray-700 font-medium mb-1">Confirme a Senha</label>
            <input
                type="password"
                id="confirma_senha"
                name="confirma_senha"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <!-- Botão Cadastrar -->
        <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-xl font-semibold hover:bg-blue-700 transition duration-200">
            Cadastrar
        </button>

        <!-- Botão Voltar para Login -->
        <button
            type="button"
            onclick="window.location.href='../index.html'"
            class="w-full bg-red-600 text-white py-2 rounded-xl font-semibold hover:bg-red-700 transition duration-200">
            Voltar para o Login
        </button>
    </form>
</body>

</html>