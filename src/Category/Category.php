<?php

namespace San4ezZ\Parser777\Category;

use San4ezZ\Parser777\Request\RequestInterface;

class Category implements CategoryInterface
{
    private RequestInterface $request;
    private array $list = [];
    private string $url;


    public function __construct(RequestInterface $request, string $date, string $prefix = '?d=')
    {
        $this->request = $request;
        $this->url = $prefix . $date;
    }

    /**
     * Возвращает найденые категории за определеный день в виде массива
     * @return array
     */
    public function getList(): array
    {
        $countryFinder = new CategoryFinder($this->request->get($this->url));
        $list = $countryFinder->findAllMatchCategory();
        return $list;
    }
}
