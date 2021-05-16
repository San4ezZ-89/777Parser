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

//        $pqDiv = pq($category);
//        $caption = pq($pqDiv->find('.caption'));


        foreach ($allMatchesCategory as $category) {
            $pqLink = pq($category);

            $countryName = pq($pqLink->find('.country-name'))->text();
            $leagueName = pq($pqLink->find('.league-name'))->text();
            $categoryName = $countryName . ' ' . $leagueName;

            if (!in_array($categoryName, $this->allCountryTag)) {
                $this->allCountryTag[$categoryName] = $categoryName;
            }
        }
        return $this->allCountryTag;
    }
}
