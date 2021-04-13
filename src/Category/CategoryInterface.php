<?php

namespace San4ezZ\Parser777\Category;

use San4ezZ\Parser777\Request\RequestInterface;

interface CategoryInterface
{
    public function __construct(RequestInterface $request, string $prefix, string $date);

    public function getList(): array;
}

