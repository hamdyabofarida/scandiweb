<?php

namespace Controller;

use Model\Db;

class Product
{
    public $passed;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $frontend;
    protected $attribute_table;

    public function __construct()
    {
        $this->attribute_table = Db::query("SELECT attribute.*,attribute.name, type.name as type FROM attribute
        LEFT JOIN type
        ON attribute.type_id = type.id
        WHERE type.name=?;", [$_POST['type']]);
    }

    public function addProduct()
    {
        $query = "INSERT INTO product(sku, name, price, front_end) VALUES (?,?,?,?)";
        $params = [$this->sku, $this->name, $this->price, $this->frontend];
        Db::query($query, $params);
    }

    public static function getAttrs()
    {
        $attributes = (Db::query("SELECT attribute.name as attr, unit FROM attribute
        LEFT JOIN type
        ON attribute.type_id = type.id
        WHERE type.name=?;", [$_POST['type']]));
        echo json_encode($attributes);
    }

    public static function getProducts()
    {
        $products = (Db::query("SELECT sku, name, price, front_end FROM product;"));
        echo json_encode($products);
    }

    public static function deleteProducts()
    {
        try {
            Db::query("DELETE product , value FROM product  INNER JOIN value  
                    WHERE product.id= value.product_id and product.sku IN ('" . implode("','", $_POST['toDelete']) . "');");
            echo json_encode('deleted');
        } catch (\Throwable $e) {
            echo json_encode('failled');
        }
    }
}
