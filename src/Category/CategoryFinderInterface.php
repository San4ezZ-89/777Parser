<?php

namespace San4ezZ\Parser777\Category;

interface CategoryFinderInterface
{
    public function __construct(string $request);

    public function findAllMatchCategory(): array;
}
