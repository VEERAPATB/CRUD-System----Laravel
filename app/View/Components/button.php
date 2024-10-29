<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $text;
    public $url;
    public $color;

    public function __construct($text = 'Button', $url = '#', $type = 'button', $color = 'primary')
    {
        $this->text = $text;
        $this->url = $url;
        $this->type = $type;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.button');
    }
}
