<?php

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="profile-index">
    <h1><?=\yii\helpers\Html::encode($this->title)?></h1>

    <p>Hello!</p>

    <h2>Attach profile</h2>
    <?= yii\authclient\widgets\AuthChoice::widget([
        'baseAuthUrl' => ['profile/network/attach'],
    ]); ?>
</div>
