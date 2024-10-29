<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $text;
    public $url;
    public $type;
    public $variant;
    

    public function __construct($text = 'Button', $url = '#', $type = 'button', $variant = 'primary')
    {
        $this->text = $text;
        $this->url = $url;
        $this->type = $type;
        $this->variant = $variant; // e.g., 'create', 'edit', 'delete'
    }

    public function render()
    {
        return view('components.button');
    }
}
