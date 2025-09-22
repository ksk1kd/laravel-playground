<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ArrController extends Controller
{
    /**
     * Show the array helper methods.
     */
    public function show(Request $request): string
    {
        $users = [
            ['id' => 1, 'name' => 'John', 'age' => 30, 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane', 'age' => 25, 'email' => 'jane@example.com'],
            ['id' => 3, 'name' => 'Bob', 'age' => 35, 'email' => 'bob@example.com'],
        ];

        $products = [
            ['name' => 'Laptop', 'price' => 100000, 'category' => 'Electronics', 'stock' => 5],
            ['name' => 'Book', 'price' => 2000, 'category' => 'Education', 'stock' => 20],
            ['name' => 'Chair', 'price' => 15000, 'category' => 'Furniture', 'stock' => 0],
        ];

        $emails = Arr::pluck($users, 'email');
        dump('Arr::pluck($users, "email")', $emails);

        $userBasicInfo = [];
        foreach ($users as $user) {
            $userBasicInfo[] = Arr::only($user, ['name', 'email']);
        }
        dump('Arr::only($user, ["name", "email"])', $userBasicInfo);

        $expensiveProducts = Arr::where($products, function ($product) {
            return $product['price'] > 10000;
        });
        dump('Arr::where($products, price > 10000)', $expensiveProducts);

        return '';
    }
}