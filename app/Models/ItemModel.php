<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'item_id';
    protected $allowedFields = ['barcode', 'name', 'category_id', 'unit_id', 'price', 'image'];

    public function getItems()
    {
        return $this->select('items.*, categories.name as category_name, units.name as unit_name')
            ->join('categories', 'categories.category_id = items.category_id')
            ->join('units', 'units.unit_id = items.unit_id')
            ->findAll();

    }

    function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $this->db->query("UPDATE items SET stock = stock + $qty WHERE item_id = $id");
    }
    function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];

        $this->db->query("UPDATE items SET stock = stock - $qty WHERE item_id = $id");

    }
    public function update_stock_out_del($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];

        // Check the current stock of the item
        $item = $this->db->table('items')->select('stock')->where('item_id', $id)->get()->getRow();

        if ($item && $item->stock >= $qty) {
            // Proceed with the stock update if there's enough stock
            $this->db->query("UPDATE items SET stock = stock - $qty WHERE item_id = $id");
            return true;
        } else {
            // Return false if the stock is insufficient
            return false;
        }
    }


}
