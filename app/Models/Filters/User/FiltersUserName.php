<?php

namespace App\Models\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersUserName implements Filter
{

    public function __invoke(Builder $query, $value, string $property)
    {
        $value = mb_strtolower($value); // Convert search term to lowercase

        $query->whereRaw('LOWER(first_name) like ?', ['%' . $value . '%'])
            ->orWhereRaw('LOWER(last_name) like ?', ['%' . $value . '%']);
    }
}
