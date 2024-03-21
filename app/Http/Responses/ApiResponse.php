<?php

namespace App\Http\Responses;

class ApiResponse
{
    public $status;
    public $message;
    public $data;
    public $total;

    public function __construct($status, $message = '', $data = [], $total = 0)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
        $this->total = $total;
    }
}