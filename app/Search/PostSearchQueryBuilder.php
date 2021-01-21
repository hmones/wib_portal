<?php

namespace App\Search;

use ElasticScoutDriverPlus\Builders\QueryBuilderInterface;

final class PostSearchQueryBuilder implements QueryBuilderInterface
{
    /**
     * @var string
     */
    private $searchQuery;

    public function searchQuery(string $searchQuery): self
    {
        $this->searchQuery = $searchQuery;
        return $this;
    }

    public function buildQuery(): array
    {
        return [
            'match_phrase_prefix' => [
                'content' => [
                    'query' => $this->searchQuery,
                ]
            ]
        ];
    }
}