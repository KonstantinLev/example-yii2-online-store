<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 07.07.2019
 * Time: 14:06
 */

namespace src\tests\unit\entities\Shop\Brand;

use Codeception\Test\Unit;
use src\entities\Meta;
use src\entities\Shop\Brand;


class CreateTest extends Unit
{
    public function testSuccess()
    {
        $brand = Brand::create(
            $name = 'Brand',
            $slug = 'slug',
            $meta = new Meta('Title', 'Description', 'Keywords')
        );

        $this->assertEquals($name, $brand->name);
        $this->assertEquals($slug, $brand->slug);
        $this->assertEquals($meta, $brand->meta);
    }
}