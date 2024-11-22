<?php

namespace App\Libraries; // Adjust the namespace as per your application structure

class Template
{
    protected $template_data = [];

    public function set($name, $value)
    {
        $this->template_data[$name] = $value;
    }

    public function load($template = '', $view = '', $view_data = [], $return = false)
    {
        $renderer = service('renderer');

        // Load the view into contents
        $this->set('contents', $renderer->setData($view_data)->render($view));

        // Load the template with template_data
        return $renderer->setData($this->template_data)->render($template);
    }
}
?>