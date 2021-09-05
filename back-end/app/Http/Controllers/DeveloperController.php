<?php

namespace App\Http\Controllers;

use App\Services\DeveloperService;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function __construct(DeveloperService $s)
    {
        parent::__construct($s);
    }
}
