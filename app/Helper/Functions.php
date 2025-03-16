<?php

use Illuminate\Support\Arr;

function getClassByAction($action): string
{
    return Arr::get(getClasses(), $action, 'primary');
}

function getClasses(): array
{
    return [
        'created' => 'success',
        'updated' => 'primary',
        'deleted' => 'danger',
        'forceDeleted' => 'secondary',
        'restored' => 'warning',
    ];
}
