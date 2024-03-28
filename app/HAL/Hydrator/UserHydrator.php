<?php

namespace App\HAL\Hydrator;

use ApiSkeletons\Laravel\HAL\AbstractHydrator as Hydrator;
use ApiSkeletons\Laravel\HAL\Resource;

final class UserHydrator extends Hydrator
{
    public function extract($class): Resource
    {
        $data = [];

        $fields = [
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'
        ];

        // Extract fields into an array to be used by the resource
        foreach ($fields as $field) {
            $data[$field] = $class->$field;
        }

        // Create a new resource and assign self link and extract the
        // roles into an embedded resource.  Note `addEmbeddedResources`
        // is used for arrays and `addEmbeddedResource` is used for classes
        return $this->hydratorManager->resource($data)
            ->addLink('self', route('user.show', $class->id));
    }
}