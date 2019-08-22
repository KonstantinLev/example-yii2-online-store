<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 24.07.2019
 * Time: 6:20
 */

namespace src\forms\Shop;

use yii\base\Model;

class ReviewForm extends Model
{
    public $vote;
    public $text;

    public function rules(): array
    {
        return [
            [['vote', 'text'], 'required'],
            [['vote'], 'in', 'range' => array_keys($this->votesList())],
            ['text', 'string'],
        ];
    }

    public function votesList(): array
    {
        return [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ];
    }
}