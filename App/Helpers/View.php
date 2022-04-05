<?php
declare(strict_types=1);

namespace App\Helpers;

class View
{
    public static function render(string $view, array $data = [])
    {
        require(VIEWS_PATH .'/'. $view . '.php');
    }
}