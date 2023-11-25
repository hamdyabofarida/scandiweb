<?php
namespace Controller;

use Model\Type;
use Model\Db;
use Model\Validation;

class Furniture extends Product implements Type
{
    public $attributes = [];

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
            'width' => [
                'required' => [],
                'digits' => [],
            ],
            'height' => [
                'required' => [],
                'digits' => [],
            ],
            'length' => [
                'required' => [],
                'digits' => [],
            ],
        ]);
        if (count(Validation::getErrors()) == 0) {
            $this->sku = $_POST['sku'];
            $this->name = $_POST['name'];
            $this->price = $_POST['price'];
            $this->type = $_POST['type'];
            $this->attributes = [
                'width' => $_POST['width'], 
                'height' => $_POST['height'], 
                'length' => $_POST['length']
            ];
        }


    }

    public function frontendFormate()
    {
        $this->frontend = $this->attributes['height'] . 'x' . $this->attributes['width'] . 'x' . $this->attributes['length'] . $this->attribute_table[0]['unit'];
        return $this->frontend;
    }

    public function addValue()
    {
        foreach ($this->attributes as $attribute_key => $attribute_value) {
            $lastId = Db::productLastId('product');
            $attribute_table = Db::query("SELECT attribute.*,attribute.name, type.name as type FROM attribute
            LEFT JOIN type
            ON attribute.type_id = type.id
            WHERE attribute.name=?;", [$attribute_key]);

            $query = "INSERT INTO value(product_id, attribute_id, attribute_value) VALUES (?,?,?)";
            $params = [$lastId['last'], $attribute_table[0]['id'], $attribute_value];
            Db::query($query, $params);
        }
    }
}
