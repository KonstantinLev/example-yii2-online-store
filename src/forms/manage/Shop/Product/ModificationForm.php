<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 11.07.2019
 * Time: 21:12
 */

namespace src\forms\manage\Shop\Product;

use src\entities\Shop\Product\Modification;
use yii\base\Model;

class ModificationForm extends Model
{
    public $code;
    public $name;
    public $price;
    public $quantity;

    public function __construct(Modification $modification = null, $config = [])
    {
        if ($modification) {
            $this->code = $modification->code;
            $this->name = $modification->name;
            $this->price = $modification->price;
            $this->quantity = $modification->quantity;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['code', 'name', 'quantity'], 'required'],
            [['price'], 'integer'],
        ];
    }
}