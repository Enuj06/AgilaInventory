<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class WebController extends BaseController
{
    public function website()
    {
        return view('website/index');
    }
    public function about()
    {
        return view('website/about');
    }
    public function shop()
    {
        return view('website/shop');
    }
    public function contact()
    {
        return view('website/contact');
    }
    public function error()
    {
        return view('website/404');
    }
    public function cart()
    {
        return view('website/cart');
    }
    public function checkout()
    {
        return view('website/checkout');
    }
    public function index2()
    {
        return view('website/index_2');
    }
    public function mail()
    {
        return view('website/mail');
    }
    public function news()
    {
        return view('website/news');
    }
    public function singleproduct()
    {
        return view('website/single-product');
    }
    public function singlenews()
    {
        return view('website/single-news');
    }

}
