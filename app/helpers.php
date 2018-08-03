<?php

if (! function_exists('assignColor')) {
    function assignColor(\Illuminate\Support\Collection $collection) {
        $colors = collect(['red', 'blue', 'pink', 'maroon', 'grey'])
            ->take($collection->count())
            ->toArray();

        return $collection->combine($colors);
    }
}
