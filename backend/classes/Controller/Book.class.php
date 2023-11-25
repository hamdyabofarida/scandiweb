<?php

namespace Controller;

use Model\Type;
use Model\Db;
use Model\Validation;

class Book extends Product implements Type
{
    public $weight;

    public function __construct()
    {
        parent::__construct();
        Validation::validate([
            'sku' => [
                'required' => [],
                'unique' => ['product']
            ],
            'name' => [
                'required' => [],
            ],
            'price' => [
                'required' => [],
                'digits' => [],
            ],
            'type' => [
                'required' => [],
            ],
            'weight' => [
                'required' => [],
                'digits' => [],
            ],
        ]);
        if (count(Validation::getErrors()) == 0) {
            $this->sku = $_POST['sku'];
            $this->name = $_POST['name'];
            $this->price = $_POST['price'];
            $this->type = $_POST['type'];
            $this->weight = $_POST['weight'];
        }
    }

    public function frontendFormate()
    {
        $this->frontend = $this->weight . $this->attribute_table[0]['unit'];
        return $this->frontend;
    }

    public function addValue()
    {
        $lastId = Db::productLastId('product');
        $attribute_table = Db::query("SELECT attribute.*,attribute.name, type.name as type FROM attribute
            LEFT JOIN type
            ON attribute.type_id = type.id
            WHERE attribute.name=?;", ['weight']);

        $query = "INSERT INTO value(product_id, attribute_id, attribute_value) VALUES (?,?,?)";
        $params = [$lastId['last'], $attribute_table[0]['id'], $this->weight];
        Db::query($query, $params);
    }
}
