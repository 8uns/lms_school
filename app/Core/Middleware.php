<?php


namespace App\Core;

interface Middleware
{
    function before(): void;
}
