<?php

namespace App\Traits;

use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as Generator;
use Illuminate\Support\Str;


trait Sigerprojectuuid
{
    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
        // static::creating(function ($model) {
        //     if (empty($model->{$model->getKeyName()})) {
        //         $model->{$model->getKeyName()} = $model->uid();
        //     }
        // });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * gen uid
     * @param int $limit
     * @return false|string
     */
    public function uid($limit = 16)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
