<?php

namespace Modules\Authorization\Entities;

use Modules\Core\Traits\HasTranslations;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasTranslations;

    public $translatable = ['display_name'];
}
