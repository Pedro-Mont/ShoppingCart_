<?php

class Products {
    private array $products;

    public function __construct() {
        $this->products = [
            ['productId' => 1, 'name' => 'Smartphone', 'price' => 1999.90, 'productStock' => 30],
            ['productId' => 2, 'name' => 'Notebook', 'price' => 3500.00, 'productStock' => 20],
            ['productId' => 3, 'name' => 'Smart TV 50"', 'price' => 2500.00, 'productStock' => 15],
            ['productId' => 4, 'name' => 'Fone de Ouvido Bluetooth', 'price' => 250.00, 'productStock' => 60],
            ['productId' => 5, 'name' => 'Mouse Gamer', 'price' => 150.00, 'productStock' => 40],
            ['productId' => 6, 'name' => 'Teclado Mecânico', 'price' => 300.00, 'productStock' => 25],
            ['productId' => 7, 'name' => 'Monitor 27"', 'price' => 1200.00, 'productStock' => 18],
            ['productId' => 8, 'name' => 'Console de Videogame', 'price' => 4000.00, 'productStock' => 12],
            ['productId' => 9, 'name' => 'Caixa de Som Inteligente', 'price' => 350.00, 'productStock' => 50],
            ['productId' => 10, 'name' => 'Câmera de Ação', 'price' => 1800.00, 'productStock' => 10],
        ];
    }

    public function reduceStock(int $productId, int $quantity): void
    {
        foreach ($this->products as &$product) {
            if ($product['productId'] === $productId) {
                $product['productStock'] -= $quantity;
            }
        }
    }

    public function returnStock(int $productId, int $quantity): void
    {
        foreach ($this->products as &$product) {
            if ($product['productId'] === $productId) {
                $product['productStock'] += $quantity;
            }
        }
    }

    public function getProductByID(int $id): ?array {
        foreach ($this->products as $product){
            if($product['productId'] === $id){
                return $product;
            }
        }
        return null;
    }

    public function validateProduct(int $productId, int $quantity): string|bool
    {
        $product = $this->getProductByID($productId);

        if ($product === null) {
            return "Produto não encontrado";
        }

        if ($quantity > $product['productStock']) {
            return "Estoque insuficiente";
        }

        return true;
    }
} 

class ShoppingCart{
    private array $cart;
    private ?string $coupon = null;

    public function __construct() {
        $this->cart = [];
    }
    
    public function addProduct(int $productId, int $quantity, Products $products): string
    {
        $check = $products->validateProduct($productId, $quantity, $products);
        if ($check !== true) {
            return $check; 
        }
        
        $productData = $products->getProductByID($productId);

        foreach ($this->cart as &$product) {
            if ($product['productId'] === $productId) {
                $product['quantity'] += $quantity;
                $product['subtotal'] = $product['quantity'] * $productData['price'];
                $products->reduceStock($productId, $quantity);
                return "Adicionado com sucesso";
            }
        }

        $this->cart[] = [
            'productId' => $productData['productId'], 
            'quantity' => $quantity,
            'subtotal'   => $productData['price'] * $quantity,];

        $products->reduceStock($productId, $quantity);

        return "Adicionado com sucesso";
    }

    public function removeProduct(int $productId, Products $products): string
    {
        $check = $products->validateProduct($productId, 1);
        if ($check !== true) {
            return $check;
        }

        foreach ($this->cart as $key => $product) {
            if ($product['productId'] === $productId) {
                $products->returnStock($productId, $product['quantity']);
                unset($this->cart[$key]);
                return "Removido com sucesso";
            }
        }

        return "Problema para remover";
    }

    public function applyCoupon(string $coupon): string
    {
        if ($coupon === 'DESCONTO10') {
            $this->coupon = $coupon;
            return "Cupom aplicado";
        }
        return "Cupom inválido";
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['subtotal'];
        }

        if ($this->coupon === 'DESCONTO10'){
            $total *= 0.9;
        }

        return $total;
    }

    public function getCart(): array
    {
        return ['items' => $this->cart, 
        'total' => $this->getTotal(), 
        'cupom'   => $this->coupon ?? 'Nenhum',];
    }
}