<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 08.07.2019
 * Time: 15:15
 */

namespace src\repositories\events;

class EntityRemoved
{
    public $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }
}