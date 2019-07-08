<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 08.07.2019
 * Time: 15:11
 */

namespace src\repositories\Shop;

use src\entities\Shop\Category;
use src\repositories\events\EntityPersisted;
use src\repositories\events\EntityRemoved;
use src\repositories\NotFoundException;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CategoryRepository
{
    private $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function get($id): Category
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Category is not found.');
        }
        return $category;
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error.');
        }
        //$this->dispatcher->dispatch(new EntityPersisted($category));
    }

    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
        //$this->dispatcher->dispatch(new EntityRemoved($category));
    }
}