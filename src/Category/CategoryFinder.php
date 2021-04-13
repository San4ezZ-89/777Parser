<?php

namespace San4ezZ\Parser777\Category;

require_once __DIR__ . '/../phpQuery/phpQuery.php';


class CategoryFinder implements CategoryFinderInterface
{
    private string $request;
    private array $allCountryTag;
    private \phpQueryObject $pq;

    public function __construct(string $request)
    {
        $this->request = $request;
        $this->allCountryTag = array();
        $this->pq = \phpQuery::newDocument($this->request);
    }

    /**
     * В полученом тексте ищем все категории в заголовках. Помещаем в массив, удаляя пробелы и проверяя на дубли
     * @return array
     */
    public function findAllMatchCategory(): array
    {
        $allMatchesCategory = $this->pq->find('.caption');
        foreach ($allMatchesCategory as $category) {
            $pqLink = pq($category);
            if (!in_array($pqLink->text(), $this->allCountryTag)) {
                $this->allCountryTag[trim($pqLink->text())] = trim($pqLink->text());
            }
        }
        return $this->allCountryTag;
    }
}