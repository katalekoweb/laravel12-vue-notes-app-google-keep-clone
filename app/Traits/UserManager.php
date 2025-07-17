<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Models\Tenant;
use Ramsey\Uuid\Uuid;

trait UserManager
{
    public static function bootUserManager()
    {
        static::creating(function (Model $model) {
            $user = Auth::user();
            if ($user) {
                if (empty($model->user_id)) {
                    $model->user_id = $user->id;
                }
            }
            if (empty($model->uuid)) {
                $model->uuid = (string) Uuid::uuid4();
            }
        });

        static::addGlobalScope('user', function (Builder $builder) {
            $user = Auth::user();
            if ($user) {
                $builder->where('user_id', $user->id);
            }
        });
    }

}
