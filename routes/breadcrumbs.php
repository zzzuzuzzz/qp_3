<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Главная страница 
Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('index'));
});



// Главная станица > Страницы со статической информацией + страница с салонами
Breadcrumbs::for('info_pages', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('index');
    $trail->push($title);
});



// Главная станица > Страница с новостями
Breadcrumbs::for('articles', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Все новости', route('articles'));
});
// Главная станица > Страница с новостями > Новость
Breadcrumbs::for('article', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('articles');
    $trail->push($title);
});



// Главная станица > Каталог > Возможный подвид каталога
Breadcrumbs::for('catalog', function (BreadcrumbTrail $trail, $title, $addPage) {
    $trail->parent('index');
    $trail->push('Каталог', route('catalog'));
    if ($addPage !== null) {
        $trail->push($addPage->name, route('catalog', ['slug' => $addPage->slug]));
    }
});
// Главная станица > Каталог > Страница продукта
Breadcrumbs::for('product', function (BreadcrumbTrail $trail, $title, $add_page) {
    $trail->parent('index');
    $trail->push('Каталог', route('catalog'));
    $trail->push($title);
});



// Главная станица > Страница Авторизации
Breadcrumbs::for('login', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('index');
    $trail->push($title);
});
// Главная станица > Страница регистрации
Breadcrumbs::for('register', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('index');
    $trail->push($title,);
});
// Главная станица > Страница Подтверждение пароля
Breadcrumbs::for('confirmPassword', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('index');
    $trail->push($title);
});
// Главная станица > Восстановление пароля
Breadcrumbs::for('forgotPassword', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('index');
    $trail->push($title);
});
// Главная станица > Сброс пароля
Breadcrumbs::for('resetPassword', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('index');
    $trail->push($title);
});
// Главная станица > Подтверждение регистрации
Breadcrumbs::for('verifyEmail', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('index');
    $trail->push($title);
});



// Главная станица > Профиль
Breadcrumbs::for('account', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('index');
    $trail->push($title);
});