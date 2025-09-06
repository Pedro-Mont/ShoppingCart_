# ShoppingCart

## Integrantes
- Pedro Monteiro Silva - 2000328  
- Giulio Rafael Nogueira Cruz - 1991759  

---

## Como executar o projeto
1. Extraia a pasta **ShoppingCart** do arquivo `.zip`.  
2. Coloque a pasta dentro da pasta `xampp/htdocs` no disco local.  
3. Abra o navegador e acesse:
4. http://localhost/ShoppingCart

---

## Funcionalidades implementadas

### Classe `Products`
- Possui no **construtor** os produtos com:
  - `id`
  - `nome`
  - `preço`
  - `estoque`
- **Funções principais:**
  - `getProductByID`: busca um produto pelo seu ID.
  - `validateProduct`: valida se o produto existe e se há estoque suficiente.
  - `reduceStock`: reduz o estoque de um produto.
  - `returnStock`: retorna (devolve) a quantidade de produto ao estoque.

---

### Classe `ShoppingCart`
- Inicia com um array vazio representando o carrinho.
- **Funções principais:**
  - `addProduct`:  
    - Chama `validateProduct` antes de adicionar.  
    - Se o produto já existe no carrinho, apenas atualiza a quantidade e o subtotal.  
    - Caso contrário, adiciona o produto usando `getProductByID`.  
    - Em ambos os casos, chama `reduceStock` para atualizar o estoque.
  - `removeProduct`:  
    - Remove o produto do carrinho.  
    - Chama `returnStock` para devolver o item ao estoque.
  - `applyCoupon`:  
    - Aceita o cupom `DESCONTO10` (10% de desconto).  
    - Outros cupons são considerados inválidos.
  - `getTotal`:  
    - Calcula o valor total dos itens no carrinho.  
    - Aplica o desconto do cupom se presente.
  - `getCart`:  
    - Retorna os produtos no carrinho, o total e o cupom aplicado.

---

## Casos de Teste
1. Adicionar produto válido ao carrinho → mensagem de sucesso.  
2. Adicionar produto acima da quantidade disponível → mensagem de erro "estoque insuficiente".  
3. Remover produto do carrinho → mensagem de sucesso.  
4. Aplicar cupom válido (`DESCONTO10`) → desconto aplicado ao total.  
5. Aplicar cupom inválido → mensagem de cupom inválido.  

---
