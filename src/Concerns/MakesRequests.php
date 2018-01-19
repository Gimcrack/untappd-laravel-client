<?php

namespace Ingenious\Untappd\Concerns;

use stdClass;
use Zttp\Zttp;
use Illuminate\Support\Facades\Cache;

trait MakesRequests
{
    /**
     * Get the endpoint
     * @method endpoint
     *
     * @return   string
     */
    private function endpoint()
    {
        return $this->endpoint;
    }

    /**
     * Get the formatted url
     * @method url
     *
     * @param  $url  string
     * @return string
     */
    private function url($url)
    {
        $url = vsprintf("%s/%s", [
            $this->endpoint(),
            trim($url,'/')
        ]);

        return $url;
    }

    /**
     * Get the requested url
     *
     * @param      <type>  $url    The url
     */
    private function get( $url )
    {
        return Zttp::get( $url, $this->params + [
            'client_id' => $this->client_id,
            'client_secret' => $this->secret
        ]);
    }

    /**
     * Get the request url and return json
     * @method getJson
     *
     * @param $url
     * @return StdClass
     */
    private function getJson($url)
    {
        $expanded = $this->url($url);

        if ( $this->force_flag )
        {
            Cache::forget($this->getCacheKey($url));
        }

        $this->force_flag = false;

        return Cache::remember( $this->getCacheKey($url), 15, function() use ($expanded) {
            $json = $this->get($expanded)->json();

            return (object) $json;
        });
    }

    /**
     * Add request parameter
     * @method addParam
     * @param  $key  string
     * @param  $value  mixed
     *
     * @return   $this
     */
    private function addParam($key, $value)
    {
        $this->params[$key] = $value;

        return $this;
    }

    /**
     * Get the cache key for the request
     * @method getCacheKey
     * @param $url
     * @return string
     */
    private function getCacheKey($url)
    {
        return "untappd." . $this->url($url) . "." . collect($this->params)->toJson();
    }
}
