<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class Invoice extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'invoices';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'date',
        'due_date',
        'status',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Creates a new invoice ID.
     *
     * @return int The newly created invoice ID.
     */
    public function createID(): int
    {
        $now = new Time();

        $invoice = [
            'date'     => $now->toDateTimeString(),
            'due_date' => $now->subDays(1)->toDateTimeString(),
            'status'   => 'unpaid',
        ];

        return $this->insert($invoice);
    }
}
