<?php
namespace Controller;

use Model\Type;
use Model\Validation;

class DefaultType extends Product implements Type
{
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
        ]);
    }

    public function frontendFormate()
    {
        return;
    }

    public function addValue()
    {
        return;
    }
}
