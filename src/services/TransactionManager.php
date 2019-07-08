<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 08.07.2019
 * Time: 23:16
 */

namespace src\services;

class TransactionManager
{
    public function wrap(callable $function): void
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $function();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}