<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 07.07.2019
 * Time: 13:49
 */

namespace src\repositories\Shop;


use src\entities\Shop\Tag;

class TagRepository
{
    public function findByName($name): ?Tag
    {
        return Tag::findOne(['name' => $name]);
    }

    public function get($id): Tag
    {
        if (!$tag = Tag::findOne($id)) {
            throw new NotFoundException('Tag is not found.');
        }
        return $tag;
    }

    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}