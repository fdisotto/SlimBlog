<?php
$app->get('/[{page:\d+}]', App\Action\HomeAction::class)->setName('homepage');
$app->get('/article/{slug}', App\Action\ArticleAction::class)->setName('article');
$app->get('/logout', App\Action\HomeAction::class . ':logout')->setName('logout');

$app->group('/admin', function() use ($is_logged, $is_not_logged) {
    $this->get('', App\Action\AdminAction::class)->setName('admin')->add($is_logged);
    $this->post('/login', App\Action\AdminAction::class . ':login')->setName('admin-login')->add($is_logged);
    $this->get('/dashboard', App\Action\AdminAction::class . ':dashboard')->setName('admin-dashboard')->add($is_not_logged);
});
