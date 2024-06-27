<?php

namespace App\Controller;

use App\Core\Controller;

class ErrorController extends Controller
{
    public function notFound()
    {
        return $this->renderView("_404");
    }
}