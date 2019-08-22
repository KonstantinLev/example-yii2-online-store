<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 11.06.2019
 * Time: 23:29
 */

namespace common\bootstrap;


use frontend\urls\CategoryUrlRule;
use src\repositories\Shop\CategoryRepository;
use src\services\auth\PasswordResetService;
use src\services\contact\ContactService;
use yii\base\BootstrapInterface;
use yii\caching\Cache;
use yii\di\Instance;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;
// пример
//        $container->setSingleton(PasswordResetService::class, function () use ($app) {
//           return new PasswordResetService([$app->params['supportEmail'] => $app->name . ' robot']);
//        });

//        $container->setSingleton(PasswordResetService::class, [], [
//            [$app->params['supportEmail'] => $app->name . ' robot'],
//            $app->mailer
//        ]);

        $container->setSingleton(PasswordResetService::class); //todo можно удалить, так как будет попытка создания через new

//        $container->setSingleton('super_mailer', function() use ($app) {
//           return $app->mailer;
//        });

        $container->setSingleton(MailerInterface::class, function() use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail'],
            Instance::of(MailerInterface::class)//todo можно не указывать, так как при парсинге конструктора контейнер зайдет в функцию выше
        ]);

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        $container->set(CategoryUrlRule::class, [], [
            Instance::of(CategoryRepository::class),
            Instance::of('cache')
        ]);
    }
}