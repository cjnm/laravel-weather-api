<?php
namespace App\HAL;

use ApiSkeletons\Laravel\HAL\AbstractHydratorManager as HALHydratorManager;

final class HydratorManager extends HALHydratorManager
{
    public function __construct() 
    {
        $this->classHydrators = [
            \App\Models\User::class => \App\HAL\Hydrator\UserHydrator::class,
        ];
    }
}