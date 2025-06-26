# 💰 Sistema de Gestão de Vendas com Mercado Pago

Este sistema permite que vendedores cadastrem produtos, gerem vendas e recebam pagamentos por **PIX**, **boleto** ou **cartão de crédito** usando a API do **Mercado Pago**. Também possui painel de controle com listagem e relatório de vendas.

---

## 🚀 Funcionalidades

- Cadastro e login de usuários (vendedores)
- Cadastro de produtos à venda
- Cadastro das credenciais do Mercado Pago (public key e access token)
- Criação de vendas com múltiplos produtos
- Geração de links únicos para pagamento
- Tela de checkout para o comprador (sem login)
- Integração com a API do Mercado Pago para gerar cobranças
- Notificação automática quando a fatura é paga (webhook)
- Dashboard com total de vendas, valor recebido e mais

---

## 🧑‍💼 Tipos de Usuário

### 1. **Vendedor (usuário logado):**
- Cadastra produtos
- Cria e gerencia vendas
- Recebe o pagamento direto na sua conta Mercado Pago
- Visualiza relatórios no painel

### 2. **Comprador (usuário externo):**
- Acessa o link da venda
- Escolhe forma de pagamento
- Realiza o pagamento no checkout

---

## 🛠️ Tecnologias Utilizadas

- PHP (puro)
- MySQL (com PDO)
- HTML, CSS e JavaScript
- API do Mercado Pago
- jQuery (no frontend)
- Tailwind CSS (opcional)

---

## 🗄️ Estrutura do Banco de Dados (resumo)

- `usuarios`: vendedores do sistema
- `produtos`: produtos que podem ser vendidos
- `vendas`: cabeçalho da venda
- `venda_itens`: produtos da venda
- `pagamentos`: registros do Mercado Pago
- `credenciais_mercado_pago`: chaves da conta do vendedor
- `notificacoes_mercado_pago`: auditoria do webhook

---


