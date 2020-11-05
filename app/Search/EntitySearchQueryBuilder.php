<?php

namespace App\Search;

use ElasticScoutDriverPlus\Builders\QueryBuilderInterface;

final class EntitySearchQueryBuilder implements QueryBuilderInterface
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
            'multi_match' => [
                'query' => $this->searchQuery,
                'type' => 'best_fields',
                'fields' => ['name', 'name_additional'],
                'fuzziness' => 'AUTO'
            ]
        ];
    }
}