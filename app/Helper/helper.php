<?php

use App\Models\Comments;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\User;

if (!function_exists('get_related_product')) {
    /**
     * Query product related
     *
     * @param [type] $id
     * @return array
     */
    function get_related_product($id)
    {
        $product = Product::findOrFail($id);

        return Product::with('productImage.color')
            ->where('product_type', $product->product_line)
            ->where('id', '!=', $id)
            ->orderBy('id', 'DESC')
            ->get();
    }
}

if (!function_exists('action_create_user')) {
    /**
     * Create user from simple data and return user id
     *
     * @param array $dataUser
     * @return void
     */
    function action_create_user($dataUser = [])
    {
        return User::create([
            'name'      => $dataUser['full_name'],
            'email'     => $dataUser['email'],
            'password'  => bcrypt('12345678'),
            'gender'    => $dataUser['gender'] ?? 0,
            'address'   => $dataUser['address'] ?? '',
        ]);
    }
}

if (!function_exists('get_color_from_id')) {
    /**
     * Create user from simple data and return user id
     *
     * @param array $dataUser
     * @return void
     */
    function get_color_from_id($id_color)
    {
        return ProductColor::findOrFail($id_color);
    }
}

if (!function_exists('calculateAverageReview')) {
    /**
     * Create user from simple data and return user id
     *
     * @param array $dataUser
     * @return void
     */
    function calculateAverageReview($product_id, $coloum = 'rating')
    {
        $averageStar = Comments::where('product_id', $product_id)->avg($coloum);

        return !empty($averageStar) ? ceil($averageStar) : 0;
    }
}
