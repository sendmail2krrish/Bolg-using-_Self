<?php

namespace LiteSite;

final class Exception
{
    private $file;

    public function __construct()
    {
        $this->file = file_get_contents("../Engine/Exceptions/Messages.php");
    }

    public function showException($e)
    {
        return $this->file;
    }
}
