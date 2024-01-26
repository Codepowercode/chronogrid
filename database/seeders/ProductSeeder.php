<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::create([
            "user_id" => 3,
            "serial_number" => "123123",
            "brand" => "Casio",
            "description" => "15213215",
            "model_number" => "887451221",
            "model" => "Daytona Yellow Gold",
            "color" => "red",
            "size" => "150",
            "metal" => "stile",
            "condition" => "used",
            "more_condition" => "papers",
            "year" => "1995",
            "bezel_size" => "145",
            "bezel_type" => "mura",
            "bezel_metal" => "gold",
            "bracelet_type" => "metalic",
            "band" => "mard",
            "dial_type" => "firu",
            "price" => "1500",
            "shipping" => "buyer",
            "min_offer_price" => "1400",
            "auction" => "0",
            "status_position" => "approved",
        ]);
        $product = Product::create([
            "user_id" => 3,
            "serial_number" => "1231234",
            "brand" => "Casio",
            "description" => "1221422",
            "model_number" => "5542154",
            "model" => "Daytona Yellow Silver",
            "color" => "red",
            "size" => "150",
            "metal" => "stile",
            "condition" => "used",
            "more_condition" => "papers",
            "year" => "1995",
            "bezel_size" => "145",
            "bezel_type" => "mura",
            "bezel_metal" => "gold",
            "bracelet_type" => "metalic",
            "band" => "mard",
            "dial_type" => "firu",
            "price" => "850",
            "shipping" => "buyer",
            "min_offer_price" => "500",
            "auction" => "0",
            "status_position" => "approved",
        ]);
        $product = Product::create([
            "user_id" => 3,
            "serial_number" => "1231235",
            "brand" => "Rolex (auction)",
            "description" => "52216125",
            "model" => "SF-800",
            "model_number" => "1221154",
            "color" => "blue",
            "size" => "100",
            "metal" => "stile",
            "condition" => "new",
            "more_condition" => "box",
            "year" => "2002",
            "bezel_size" => "132",
            "bezel_type" => "mura",
            "bezel_metal" => "silver",
            "bracelet_type" => "metalic",
            "band" => "mard",
            "dial_type" => "firu",
            "price" => "2600",
            "shipping" => "buyer",
            "min_offer_price" => "1400",
            "auction" => "1",
            "auction_price" => "2600",
            "auction_min_bid" => "50",
            "auction_start" => "2022-05-24 09:52:20",
            "auction_end" => "2022-06-24 09:52:20",
            "status_position" => "rejected",
        ]);

        $product = Product::create([
            "user_id" => 1,
            "serial_number" => "1231236",
            "brand" => "Casio",
            "description" => "Oyster perpetual submariner date watch",
            "model_number" => "5312245",
            "model" => "SF-700",
            "color" => "black",
            "size" => "150",
            "metal" => "stile",
            "condition" => "used",
            "more_condition" => "papers",
            "year" => "2009",
            "bezel_size" => "145",
            "bezel_type" => "mura",
            "bezel_metal" => "gold",
            "bracelet_type" => "metalic",
            "band" => "mard",
            "dial_type" => "firu",
            "price" => "1500",
            "shipping" => "seller",
            "min_offer_price" => "1400",
            "auction" => "0",
            "status" => "1",
            "status_position" => "waiting",
        ]);

        $product = Product::create([
            "user_id" => 1,
            "serial_number" => "1231237",
            "brand" => "Omega",
            "description" => "description3 description3 description3",
            "model_number" => "112315548",
            "model" => "141",
            "color" => "black",
            "size" => "10",
            "metal" => "stile",
            "condition" => "used",
            "more_condition" => "papers",
            "year" => "2007",
            "bezel_size" => "145",
            "bezel_type" => "mura",
            "bezel_metal" => "gold",
            "bracelet_type" => "metalic",
            "band" => "mard",
            "dial_type" => "firu",
            "price" => "1500",
            "shipping" => "seller",
            "min_offer_price" => "1400",
            "auction" => "0",
            "status" => "1",
            "status_position" => "waiting",
        ]);

        ProductImage::create([
            "product_id" => 1,
            "path" => "test/1.jpg",
        ]);
        ProductImage::create([
            "product_id" => 1,
            "path" => "test/2.jpg",
        ]);
        ProductImage::create([
            "product_id" => 1,
            "path" => "test/3.jpg",
        ]);
        ProductImage::create([
            "product_id" => 1,
            "path" => "test/4.jpg",
        ]);
        ProductImage::create([
            "product_id" => 1,
            "path" => "test/5.jpg",
        ]);
        ProductImage::create([
            "product_id" => 1,
            "path" => "test/6.jpg",
        ]);
        ProductImage::create([
            "product_id" => 1,
            "path" => "test/7.jpg",
        ]);



        ProductImage::create([
            "product_id" => 2,
            "path" => "test/8.jpg",
        ]);
        ProductImage::create([
            "product_id" => 2,
            "path" => "test/9.jpg",
        ]);
        ProductImage::create([
            "product_id" => 2,
            "path" => "test/10.jpg",
        ]);
        ProductImage::create([
            "product_id" => 2,
            "path" => "test/11.jpg",
        ]);



        ProductImage::create([
            "product_id" => 3,
            "path" => "test/12.jpg",
        ]);
        ProductImage::create([
            "product_id" => 3,
            "path" => "test/13.jpg",
        ]);
        ProductImage::create([
            "product_id" => 3,
            "path" => "test/14.jpg",
        ]);
        ProductImage::create([
            "product_id" => 3,
            "path" => "test/15.jpg",
        ]);
        ProductImage::create([
            "product_id" => 3,
            "path" => "test/16.jpg",
        ]);
        ProductImage::create([
            "product_id" => 3,
            "path" => "test/17.jpg",
        ]);


        ProductImage::create([
            "product_id" => 4,
            "path" => "test/18.jpg",
        ]);
        ProductImage::create([
            "product_id" => 4,
            "path" => "test/19.jpg",
        ]);
        ProductImage::create([
            "product_id" => 4,
            "path" => "test/20.jpg",
        ]);
        ProductImage::create([
            "product_id" => 4,
            "path" => "test/21.jpg",
        ]);
        ProductImage::create([
            "product_id" => 4,
            "path" => "test/22.jpg",
        ]);
        ProductImage::create([
            "product_id" => 4,
            "path" => "test/23.jpg",
        ]);


        ProductImage::create([
            "product_id" => 5,
            "path" => "test/24.jpg",
        ]);
        ProductImage::create([
            "product_id" => 5,
            "path" => "test/25.jpg",
        ]);
        ProductImage::create([
            "product_id" => 5,
            "path" => "test/26.jpg",
        ]);
        ProductImage::create([
            "product_id" => 5,
            "path" => "test/27.jpg",
        ]);
        ProductImage::create([
            "product_id" => 5,
            "path" => "test/28.jpg",
        ]);
        ProductImage::create([
            "product_id" => 5,
            "path" => "test/29.jpg",
        ]);
        ProductImage::create([
            "product_id" => 5,
            "path" => "test/30.jpg",
        ]);
        ProductImage::create([
            "product_id" => 5,
            "path" => "test/31.jpg",
        ]);






    }
}
