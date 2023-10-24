<?php

namespace Fixel\PurgeDoCdnCache;

use DigitalOceanV2\Api\CdnEndpoint;
use DigitalOceanV2\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Statamic\Http\Controllers\Controller as StatamicController;

class Controller extends StatamicController
{
    public Client $client;
    public CdnEndpoint $cdns;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->authenticate(config('purge-do-cdn-cache.token'));
        $this->cdns = $this->client->cdnEndpoint();
    }

    public function cdns(Request $request): Collection
    {
        return $this->getAll();
    }

    public function purge(Request $request, string $origin): void
    {
        if ($endpoint = $this->getAll()->firstWhere('origin', $origin)) {
            $this->cdns->purgeCache($endpoint->id);
        }
    }

    protected function getAll(): Collection
    {
        return collect($this->cdns->getAll());
    }
}
