<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 07.07.2019
 * Time: 14:45
 */

namespace src\entities;


class Meta
{
    public $title;
    public $description;
    public $keywords;

    public function __construct($title, $description, $keywords)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }
}