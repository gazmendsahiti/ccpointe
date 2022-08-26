<?php

namespace gazmendsahiti\CcPointe\Helpers;

use stdClass;

trait ResponseParser
{
    private function responseCheck(string $method)
    {
        if(!isset($this->response)){
            throw new \Exception("You can't call ".$method." before getting a response");
        }
    }

    public function toArray(): array
    {
        $this->responseCheck(__FUNCTION__);
        return json_decode($this->response, true);
    }

    public function toObject(): stdClass
    {
        $this->responseCheck(__FUNCTION__);
        return json_decode($this->response, false);
    }

    public function rawResponse(): string
    {
        $this->responseCheck(__FUNCTION__);
        return $this->response;
    }
}