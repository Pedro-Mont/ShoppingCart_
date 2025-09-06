<?php
require_once 'ShoppingCart.php';

echo "<h2>Carrinho</h2>";

$products = new Products();
$shoppingCart = new ShoppingCart();

$result1 = $shoppingCart->addProduct(1, 2, $products);
echo "<p>Adicionar 2 Smartphones: {$result1}</p>";

$result2 = $shoppingCart->addProduct(2, 2, $products);
echo "<p>Adicionar 2 Notebook: {$result2}</p>";

$result3 = $shoppingCart->addProduct(3, 20, $products);
echo "<p>Adicionar 20 Smart TVs: {$result3}</p>";

$result4 = $shoppingCart->removeProduct(2, $products);
echo "<p>Remover Notebook do carrinho: {$result4}</p>";

$result5 = $shoppingCart->applyCoupon('DESCONTO10');
echo "<p>Aplicar cupom DESCONTO10: {$result5} </p>";

$cartData = $shoppingCart->getCart();
echo "<p>Itens no carrinho:</p>";
foreach ($cartData['items'] as $item) {
    echo "<p>Produto ID: {$item['productId']}, Quantidade: {$item['quantity']}, Subtotal: {$item['subtotal']}</p>";
}
echo "<p>Cupom aplicado: {$cartData['cupom']}</p>";
echo "<p>Total final: {$cartData['total']}</p>";