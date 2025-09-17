<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CollectionController extends Controller
{
    /**
     * Show the collection.
     */
    public function show(Request $request): string
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7]);
        $chunks = $collection->chunk(4);
        dump($chunks);

        $collection = collect([1, 2, 2, 2, 3]);
        $counted = $collection->countBy();
        dump($counted);

        $collection = collect([1, 2, 3, 4]);
        $filtered = $collection->filter(function (int $value, int $key) {
            return $value > 2;
        });
        dump($filtered);

        $collection = collect([1, 2, 3, 4, 5]);
        $multiplied = $collection->map(function (int $item, int $key) {
            return $item * 2;
        });
        dump($multiplied);

        $collection = collect([
            ['name' => 'Desk', 'price' => 200],
            ['name' => 'Chair', 'price' => 100],
            ['name' => 'Bookcase', 'price' => 150],
        ]);
        $sorted = $collection->sortBy('price');
        dump($sorted);

        $collection = Collection::times(10, function (int $number) {
            return $number * 9;
        });
        dump($collection);

        $collection = collect([
            ['product' => 'Desk', 'price' => 200],
            ['product' => 'Chair', 'price' => 100],
            ['product' => 'Bookcase', 'price' => 150],
            ['product' => 'Door', 'price' => 100],
        ]);
        $filtered = $collection->where('price', 100);
        dump($filtered);

        return '';
    }
}
