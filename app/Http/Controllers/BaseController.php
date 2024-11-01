<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;

class BaseController extends Controller
{
    use ApiResponse;

    public int $pagination = 10;
}
