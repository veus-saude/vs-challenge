<?php

namespace App\Helper;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
    /**
     * @var int
     */
    private $page;
    /**
     * @var int
     */
    private $size;
    private $content;
    /**
     * @var int
     */
    private $statusCode;

    public function __construct(
        $content,
        int $statusCode = Response::HTTP_OK,
        int $page = null,
        int $size = null
    ) {
        $this->page = $page;
        $this->size = $size;
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    public function getResponse(): View
    {
        $content = [
            'page' => $this->page,
            'size' => $this->size,
            'data' => $this->content
        ];
        if (is_null($this->page)) {
            unset($content['page']);
            unset($content['size']);
        }

       return new View($content, $this->statusCode);
    }
}
