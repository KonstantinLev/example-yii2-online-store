<?php
/**
 * Created by PhpStorm.
 * User: kote
 * Date: 6/20/19
 * Time: 4:52 PM
 */

namespace src\entities\User;

use Webmozart\Assert\Assert;
use yii\db\ActiveRecord;

/**
 * Class Network
 * @property integer $user_id
 * @property string $identity
 * @property string $network
 * @package src\entities\User]
 */
class Network extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_networks}}';
    }

    public static function create($network, $identity): self
    {
        Assert::notEmpty($network);
        Assert::notEmpty($identity);
        $item = new static();
        $item->network = $network;
        $item->identity = $identity;
        return $item;
    }

    public function isFor($network, $identity): bool
    {
        return $this->network === $network && $this->identity === $identity;
    }
}