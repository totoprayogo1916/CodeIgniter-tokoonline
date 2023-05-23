<?php

namespace App\Models;

use App\Entities\Order as EntitiesOrder;
use CodeIgniter\Model;
use Totoprayogo\Lib\Cart;

class Order extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesOrder::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'invoice_id',
        'product_id',
        'product_name',
        'qty',
        'price',
        'options',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Process the cart items and insert them into the orders table.
     */
    public function process(): void
    {
        $cart         = new Cart();
        $invoiceModel = new Invoice();

        // Check if there are any items in the cart
        if ($cart->total_items() > 0) {

            // Create a unique invoice ID
            $invoice_id = $invoiceModel->createID();

            // Insert ordered items into the orders table
            foreach ($cart->contents() as $item) {
                $data = [
                    'invoice_id'   => $invoice_id,
                    'product_id'   => $item['id'],
                    'product_name' => $item['name'],
                    'qty'          => $item['qty'],
                    'price'        => $item['price'],
                ];

                $this->insert($data);
            }
        }
    }
}
