<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function masterdata()
    {
        return view("masterdata", ["key" => "Master Data"]);
    }
    public function getbook()
    {
        return view("getbook");
    }
}
