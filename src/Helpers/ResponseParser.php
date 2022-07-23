<?php

namespace gazmendsahiti\CcPointe\Helpers;

use stdClass;

trait ResponseParser
{
    public function toArray(): array
    {
        return json_decode($this->response, true);
    }

    public function toObject(): stdClass
    {
        return json_decode($this->response, false);
    }

    public function rawResponse(): string
    {
        return $this->response;
    }
}