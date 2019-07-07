<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 07.07.2019
 * Time: 15:07
 */

namespace src\forms\manage\Shop;


use src\entities\Shop\Brand;
use src\forms\CompositeForm;
use src\forms\manage\MetaForm;
use src\validators\SlugValidator;

/**
 * @property MetaForm $meta;
 */
class BrandForm extends CompositeForm
{
    public $name;
    public $slug;

    private $_brand;

    public function __construct(Brand $brand = null, $config = [])
    {
        if ($brand) {
            $this->name = $brand->name;
            $this->slug = $brand->slug;
            $this->meta = new MetaForm($brand->meta);
            $this->_brand = $brand;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Brand::class, 'filter' => $this->_brand ? ['<>', 'id', $this->_brand->id] : null]
        ];
    }

    public function internalForms(): array
    {
        return ['meta'];
    }
}