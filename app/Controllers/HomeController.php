<?php

namespace App\Controllers;

use App\Core\View;

class HomeController extends View
{
    function index(): void
    {
        $model = [
            'title' => 'Judul artikel home controller',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, sunt repellendus voluptas eligendi quod laboriosam rem ipsa quidem veniam, maiores laudantium iste. Iusto quod minus earum in cupiditate consequatur rem.',
        ];

        self::render('home/index', $model);
    }

     function about(): void
    {
        $model = [
            'title' => 'About Us',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, sunt repellendus voluptas eligendi quod laboriosam rem ipsa quidem veniam, maiores laudantium iste. Iusto quod minus earum in cupiditate consequatur rem.',
        ];

        self::render('home/about', $model);
    }

    // function login(): void
    // {
    //     self::render('/login');

    //     $request = [
    //         "username" => $_POST['username'],
    //         "password" => $_POST['password'],
    //     ];

    //     $user = [
    //         "username" => "bund",
    //         "password" => "12345",
    //         "name" => "bubuntut",
    //     ];


    //     $response = [
    //         "message" => "Login Sukses",
    //     ];
    // }

    function register(): void
    {
        self::render('/register');
    }
}
