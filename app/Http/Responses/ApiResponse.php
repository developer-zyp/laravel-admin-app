<?php

namespace App\Http\Responses;
use Illuminate\Database\Eloquent\Model;

class ApiResponse extends Model
{
    public $status;
    public $message;
    public $data;
    public $total;
    public $error;

    public function __construct($status, $message = '', $data = [], $total = 0, $error = '')
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
        $this->total = $total;
        $this->error = $error;
    }
}
