<?php

use App\Models\Comments;
use App\Models\Districts;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\Provinces;
use App\Models\User;
use Carbon\Carbon;

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
            ->where('product_line', $product->product_line)
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
        return User::updateOrCreate(['email' => $dataUser['email']], [
            'name'      => $dataUser['full_name'],
            'email'     => $dataUser['email'],
            'password'  => bcrypt('12345678'),
            'gender'    => $dataUser['gender'] ?? 0,
            'address'   => $dataUser['address'] ?? '',
            'phone'     => $dataUser['phone'] ?? '',
            'age'       => $dataUser['age'] ?? '',
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

if (!function_exists('conver_date_to_time_ago')) {
    /**
     * Create user from simple data and return user id
     *
     * @param array $dataUser
     * @return void
     */
    function conver_date_to_time_ago($dateTime)
    {
        Carbon::setLocale('vi');
        $now = Carbon::now();

        $dateDiff = Carbon::parse($dateTime);

        return $dateDiff->diffForHumans($now);
    }
}

if (!function_exists('get_product_by_prod_id_and_color')) {
    /**
     * Create user from simple data and return user id
     *
     * @param array $dataUser
     * @return void
     */
    function get_product_by_prod_id_and_color($product_id, $color_id)
    {
        return ProductImage::with(['product', 'color'])->where('product_id', $product_id)->where('color', $color_id)->first()->toArray();
    }
}

if (!function_exists('get_name_province')) {
    /**
     * Create user from simple data and return user id
     *
     * @param array $dataUser
     * @return void
     */
    function get_name_province($id)
    {
        return Provinces::find($id)->name;
    }
}

if (!function_exists('get_name_district')) {
    /**
     * Create user from simple data and return user id
     *
     * @param array $dataUser
     * @return void
     */
    function get_name_district($id)
    {
        return Districts::find($id)->name;
    }
}

function strip_tags_content($string)
{
    // ----- remove HTML TAGs -----
    $string = preg_replace('/<[^>]*>/', ' ', $string);
    // ----- remove control characters -----
    $string = str_replace("\r", '', $string);
    $string = str_replace("\n", ' ', $string);
    $string = str_replace("\t", ' ', $string);
    // ----- remove multiple spaces -----
    $string = trim(preg_replace('/ {2,}/', ' ', $string));
    return $string;
}
if (!function_exists('count_comment_by_user_id')) {
    /**
     * Count all comment of specific user
     *
     * @param array $dataUser
     * @return void
     */
    function count_comment_by_user_id($user_id, $product_id = null)
    {
        $countComment = 0;

        $count =  Comments::select([\DB::raw('COUNT(*) as count_comment')])->where('user_id', $user_id);

        if ($product_id != null) {
            $count = $count->where('product_id', $product_id);
        }

        $count = $count->groupBy('user_id')->first();

        if ($count) {
            $countComment = $count->count_comment;
        }

        return $countComment;
    }
}

if (!function_exists('truncate')) {
    /**
     * @param int $limit
     * @param array $with
     * @return \Illuminate\Support\Collection
     */
    function truncate($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
}
