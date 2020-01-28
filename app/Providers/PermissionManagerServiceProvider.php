<?php

namespace App\Providers;

class PermissionManagerServiceProvider extends \Backpack\PermissionManager\PermissionManagerServiceProvider
{
    public $routeFilePath = '/routes/backpack/custom.php';
}