<?php

namespace Amir\Encryptable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    protected static function booted(): void
    {
        static::saving(function (Model $model) {
            foreach ($model->encrypt as $col) {
                if ($model->$col != null) {
                    $model->$col = Crypt::encrypt($model->$col);
                }
            }

            return $model;
        });

        static::retrieved(function (Model $model) {
            foreach ($model->encrypt as $col) {
                if ($model->$col != null) {
                    $model->$col = Crypt::decrypt($model->$col);
                }
            }

            return $model;
        });
    }
}
