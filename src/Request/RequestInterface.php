<?php

namespace San4ezZ\Parser777\Request;

interface RequestInterface
{
    public function __construct(string $domain);

    public function get(string $url): string;
}
