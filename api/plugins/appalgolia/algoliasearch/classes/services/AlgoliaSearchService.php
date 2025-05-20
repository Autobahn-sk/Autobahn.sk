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

	/**
	 * Synchronizes the given array of objects with the search index.
	 *
	 * @param array $objects The array of objects to be synchronized with the search index.
	 * @return SearchIndex The search index after synchronization.
	 */
	public function sync(array $objects): SearchIndex
	{
		$index = $this->client->initIndex($this->index);

		$index->replaceAllObjects($objects);

		return $index;
	}

	/**
	 * Saves a single object to the search index.
	 *
	 * @param array $object The object to be saved to the search index.
	 * @return SearchIndex The search index after saving the object.
	 */
	public function save(array $object): SearchIndex
	{
		$index = $this->client->initIndex($this->index);

		$index->saveObject($object);

		return $index;
	}

	/**
	 * Deletes an object from the search index.
	 *
	 * @param int $objectId The ID of the object to be deleted from the search index.
	 * @return SearchIndex The search index after deleting the object.
	 */
	public function delete(int $objectId): SearchIndex
	{
		$index = $this->client->initIndex($this->index);

		$index->deleteObject($objectId);

		return $index;
	}

	/**
	 * Searches the index for the given query.
	 *
	 * @param string $query The search query.
	 * @param array $params Additional search parameters.
	 * @return array The search results.
	 */
	public function search(string $query, array $params = []): array
	{
		$index = $this->client->initIndex($this->index);

		return $index->search($query, $params);
	}
}
