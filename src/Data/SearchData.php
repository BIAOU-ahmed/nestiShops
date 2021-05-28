<?php

namespace App\Data;

use App\Entity\Category;

class SearchData
{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var String
     */
    public $q = '';

    /**
     * @var Category
     */
    public $categories = null;

     /**
     * @var null|integer
     */
    public $max;

    /**
     * @var null|integer
     */
    public $min;

}
