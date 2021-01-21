<?php

namespace App\Search;

use ElasticScoutDriverPlus\Builders\QueryBuilderInterface;

final class UserSearchQueryBuilder implements QueryBuilderInterface
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
                'name' => [
                    'query' => $this->searchQuery,
                ]
            ]
        ];
    }
}