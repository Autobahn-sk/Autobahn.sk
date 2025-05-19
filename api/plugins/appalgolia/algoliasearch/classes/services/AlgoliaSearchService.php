<?php namespace AppAlgolia\AlgoliaSearch\Classes\Services;

use ApplicationException;
use Algolia\AlgoliaSearch\SearchIndex;
use Algolia\AlgoliaSearch\SearchClient;

class AlgoliaSearchService
{
    protected SearchClient $client;

    protected string $index;

    /**
     * @throws ApplicationException
     */
    public function __construct(string $index)
    {
        if (!env('ALGOLIA_APP_ID') || !env('ALGOLIA_API_KEY')) {
            throw new ApplicationException('Algolia credentials not set.');
        }

        $this->client = SearchClient::create(
            env('ALGOLIA_APP_ID'),
            env('ALGOLIA_API_KEY')
        );

        $this->index = $index;
    }

	public function sync(array $objects): SearchIndex
	{
		$index = $this->client->initIndex($this->index);

		$index->replaceAllObjects($objects);

		return $index;
	}

	public function save(array $object): SearchIndex
	{
		$index = $this->client->initIndex($this->index);

		$index->saveObject($object);

		return $index;
	}

	public function delete(int $objectId): SearchIndex
	{
		$index = $this->client->initIndex($this->index);

		$index->deleteObject($objectId);

		return $index;
	}

	public function search(string $query, array $params = []): array
	{
		$index = $this->client->initIndex($this->index);

		return $index->search($query, $params);
	}
}
