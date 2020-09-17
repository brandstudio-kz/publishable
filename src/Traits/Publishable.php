<?php

namespace BrandStudio\Publishable\Traits;

trait Publishable
{

    public static function getStatusOptions() : array
    {
        return [
            static::PUBLISHED   => trans('publishable::admin.published'),
            static::DRAFT       => trans('publishable::admin.draft'),
        ];
    }

    public static function getStatusIcons() : array
    {
        return [
            static::PUBLISHED   => trans('publishable::admin.published_icon'),
            static::DRAFT       => trans('publishable::admin.draft_icon'),
        ];
    }

    public function scopeActive($query)
    {
        $query->where('status', static::PUBLISHED);
    }

    public function scopeDraft($query)
    {
        $query->where('status', static::DRAFT);
    }

    public function scopeWithActive($query, string $relation, $func = null)
    {
        $query->with([$relation => function($q) use($func) {
            $q->active();
            if ($func) {
                $func($q);
            }
        }]);
    }

    public function scopeWhereHasActive($query, string $relation, $func = null)
    {
        $query->whereHas($relation, function($q) use($func) {
            $q->active();
            if ($func) {
                $func($q);
            }
        });
    }

    public function scopeBeforeRouteBinding($query, $value, $field = null)
    {
        $query->active();
    }

    public function getShouldIndexAttribute() : bool
    {
        return $this->status == static::PUBLISHED;
    }

}
