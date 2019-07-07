<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 07.07.2019
 * Time: 12:19
 */

namespace src\tests\unit\entities\Shop\Tag;

use Codeception\Test\Unit;
use src\entities\Shop\Tag;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $tag = Tag::create($name = 'Tag', $slug = 'slug');
        $this->assertEquals($name, $tag->name);
        $this->assertEquals($slug, $tag->slug);
    }
}