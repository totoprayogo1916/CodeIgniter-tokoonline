<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Product extends CI_Model
{
    public function all()
    {
        // query semua record di table products
        $hasil = $this->db->get('products');
        if ($hasil->num_rows() > 0) {
            return $hasil->result();
        }

        return [];

    }

    public function find($id)
    {
        // Query mencari record berdasarkan ID-nya
        $hasil = $this->db->where('id', $id)
            ->limit(1)
            ->get('products');
        if ($hasil->num_rows() > 0) {
            return $hasil->row();
        }

        return [];

    }

    public function create($data_products)
    {
        // Query INSERT INTO
        $this->db->insert('products', $data_products);
    }

    public function update($id, $data_products)
    {
        // Query UPDATE FROM ... WHERE id=...
        $this->db->where('id', $id)
            ->update('products', $data_products);
    }

    public function delete($id)
    {
        // Query DELETE ... WHERE id=...
        $this->db->where('id', $id)
            ->delete('products');
    }
}
