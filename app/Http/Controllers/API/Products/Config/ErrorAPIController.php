<?php

namespace App\Http\Controllers\API\Products\Config;

use App\Http\Controllers\AppBaseController;

class ErrorAPIController extends AppBaseController
{
    private $title;
    private $code;
    private $message;
    private $file;
    private $line;
    private $status;

    public function __construct(\Exception $e, $title = null, $status = null)
    {
        $this->title = $title ?? 'Error del Sistema';
        $this->code = $e->getCode();
        $this->message = $e->getMessage();
        $this->file = $e->getFile();
        $this->line = $e->getLine();
        $this->status = $status ?? '500';
    }

    public function response()
    {
        return [
            'errors' => array(
                'title' => $this->title,
                'code' => $this->code,
                'message' => $this->message,
                'file' => $this->file,
                'line' => $this->line,
                'status' => $this->status
            )
        ];
    }
}
