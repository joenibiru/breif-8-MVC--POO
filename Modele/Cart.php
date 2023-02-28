<?php
require_once('Vue/indexView.php');
class Cart
{
    private $items = array();
    private $total = 0;

    public function addItem($product_id, $product_name, $product_price, $product_qty, $product_image)
    {
        if (isset($this->items[$product_id])) {
            $this->items[$product_id]['qty'] += $product_qty;
        } else {
            $this->items[$product_id] = array(
                'nom' => $product_name,
                'prix' => $product_price,
                'qty' => $product_qty,
                'image' => $product_image
            );
        }
    }

    public function removeItem($product_id)
    {
        if (isset($this->items[$product_id])) {
            unset($this->items[$product_id]);
        }
    }

    public function getTotal()
    {
        $this->total = 0;
        foreach ($this->items as $product) {
            $this->total += $product['prix'] * $product['qty'];
        }
        return $this->total;
    }

    public function clearCart()
    {
        $this->items = array();
    }

    public function getItems()
    {
        return $this->items;
    }
}
