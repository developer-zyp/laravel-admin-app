<?php

namespace App\Models\EasyCooking;

class HomeItem
{
    public $title;
    public $subTitle;
    public ?ViewType $viewType;
    public $visible;
    public $data;

    public function __construct($title = '', $subTitle = '', ?ViewType $viewType = null, $visible = true, $data = [])
    {
        $this->title = $title;
        $this->subTitle = $subTitle;
        $this->viewType = $viewType;
        $this->visible = $visible;
        $this->data = $data;
    }
}

class ViewType
{
    public $type;
    public $orientataion;
    public $spanCount;

    public function __construct($type = 'list', $orientataion = 'vertical', $spanCount = 1)
    {
        $this->type = $type;
        $this->orientataion = $orientataion;
        $this->spanCount = $spanCount;
    }
}