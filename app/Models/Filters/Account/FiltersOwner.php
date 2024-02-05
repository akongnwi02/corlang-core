<?php


namespace App\Models\Filters\Account;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersOwner implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $value = mb_strtolower($value); // Convert search term to lowercase

        $query->whereHas('user', function ($query) use ($value) {
            $query->whereRaw('LOWER(first_name) like ?', ['%' . $value . '%'])
                ->orWhereRaw('LOWER(last_name) like ?', ['%' . $value . '%']);
        })->orWhereHas('company', function ($query) use ($value) {
            $query->whereRaw('LOWER(name) like ?', ['%' . $value . '%']);
        });
    }
}
