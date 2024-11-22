<?php

namespace App\Controllers;

use App\Libraries\Template;

class Dashboard extends BaseController
{
    protected $template;

    public function __construct()
    {
        // Load the Template library
        $this->template = new Template();
    }

    public function index()
    {
        // Load the template and view
        echo $this->template->load('template', 'dashboard');
    }
}
