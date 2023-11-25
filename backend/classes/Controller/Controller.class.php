<?php
namespace Controller;

use Model\Actions;
use Model\Type;
use Model\Validation;

class Controller
{
    public function addProductAndValue(Type $classType)
    {
        if (count(Validation::getErrors()) > 0) {
            echo json_encode(Validation::getErrors());
        } else {
            $classType->frontendFormate();
            $classType->addProduct();
            $classType->addValue();
            echo json_encode('succeed');
        }
    }
    public function getAttrs()
    {
        Product::getAttrs();
    }
    public function getProducts()
    {
        Product::getProducts();
    }
    public function deleteProducts()
    {
        Product::deleteProducts();
    }
}
