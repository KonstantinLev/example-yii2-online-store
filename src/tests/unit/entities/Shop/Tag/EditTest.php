<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 07.07.2019
 * Time: 12:22
 */

namespace src\tests\unit\entities\Shop\Tag;

use Codeception\Test\Unit;

class EditTest extends Unit
{
    public function testSuccess()
    {
        $tag = Tag::create($name = 'Tag', $slug = 'slug');
        $tag->edit($name = 'New Tag', $slug = 'new slug');
        $this->assertEquals($name, $tag->name);
        $this->assertEquals($slug, $tag->slug);
    }
}