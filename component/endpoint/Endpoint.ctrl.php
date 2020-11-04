<?php

/* Generated by neoan3-cli */

namespace Neoan3\Components;

use Neoan3\Frame\Demo;

/**
 * Class Endpoint
 * @package Neoan3\Components
 */

class Endpoint extends Demo{

    /**
     * Get to know how API endpoints work!
     *
     * The following function accounts for the endpoints:
     *
     * GET /api.v1/endpoint
     * GET /api.v1/endpoint?any-key=any-value
     * GET /api.v1/endpoint/{userType}
     * GET /api.v1/endpoint/{userType}?any-key=any=value
     * GET /api.v1/endpoint/{userType}/{id}
     * GET /api.v1/endpoint/{userType}/{id}?any-key=any-value
     *
     * try them out by visiting these combinations in your browser
     *
     * @param string $userType
     * @param null $id
     * @param array $params
     * @return array
     */
    function getEndpoint($userType='self', $id=null, $params=[]): array
    {
        return array_merge([
            'type' => $userType,
            'id' => $id,
        ],$params);
    }
}