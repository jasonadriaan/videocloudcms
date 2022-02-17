<?php

/**
 * This package is a wrapper for v1 of the VideoCloud CMS API <a href="https://apis.support.brightcove.com/analytics/index.html">https://apis.support.brightcove.com/analytics/index.html</a>
 * @link https://apis.support.brightcove.com/analytics/index.html
 * 
 * It was created by Jason Adriaan.
 * @link https://www.jasonadriaan.com
 * 
 * You can buy me a coffee 
 * @link https://www.buymeacoffee.com/jasonadriaan
 */

namespace Jasonadriaan\VideoCloudCMS;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class VideoCloudCMS
{

    private $base_url;
    private $limit = '';
    private $offset = '';
    private $sort = '';
    private $query = '';

    public function __construct()
    {
        $this->base_url = 'https://cms.api.brightcove.com/v1/accounts/' . config('videocloudcms.account_id');
        return $this;
    }

    public function getVideo(int $video_id = null)
    {
        return $this->request($this->base_url . '/videos/' . $video_id);
    }

    public function getVideos()
    {
        return $this->request($this->base_url . '/videos?' . $this->limit . $this->offset . $this->sort . $this->query);
    }

    public function getCount()
    {
        return $this->request($this->base_url . '/counts/videos');
    }

    public function limit(int $limit = null)
    {
        $this->limit = (!empty($limit)) ? 'limit=' . $limit : ''; 
        return $this;
    }

    public function offset(int $offset = null)
    {
        $this->offset = (!empty($offset)) ? '&offset=' . $offset : ''; 
        return $this;
    }

    public function sort(string $sort = null)
    {
        $this->sort = (!empty($sort)) ? '&sort=' . $sort : ''; 
        return $this;
    }

    public function query(string $query = null)
    {
        $this->query = (!empty($query)) ? '&query=' . $query : ''; 
        return $this;
    }

    private function authenticate()
    {
         $auth_string = base64_encode(config('videocloudcms.api_key') . ':' . config('videocloudcms.api_secret'));

         $response = Http::withHeaders([
             'Content-Type' => 'application/x-www-form-urlencoded',
             'Authorization' => 'Basic ' . $auth_string,
         ])->post('https://oauth.brightcove.com/v4/access_token?grant_type=client_credentials');

         $response->throw();

         $access_token = $response->object()->access_token;
         $headers = array('Authorization' => ' Bearer ' . $access_token, 'content-type' => 'application/json');

         return $headers;
    }

    private function request($request)
    {
        $headers = $this->authenticate();
        $response = Http::withHeaders($headers)->get($request);
        $result = $response->collect();
        
        return $result;
    }

    public function update($video_id, $payload)
    {
        $request = 'https://cms.api.brightcove.com/v1/accounts/' .  config('videocloudcms.account_id') . '/videos/' . $video_id; 
        $headers = $this->authenticate();
        $response = Http::withHeaders($headers)->patch($request, $payload);
        
        return $response->successful();
    }

}
