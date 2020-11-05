<?php

/* Generated by neoan3-cli */

namespace Neoan3\Components;

use Neoan3\Apps\Ops;
use Neoan3\Core\RouteException;
use Neoan3\Frame\Demo;

/**
 * Class auth
 * @package Neoan3\Components
 */

class Auth extends Demo{

    private string $combo = '0417';
    private array $previous;


    /**
     * POST: api.v1/auth
     * @param $body
     * @return array
     * @throws RouteException
     */
    function postAuth(array $body): array
    {
        $this->previous = json_decode(file_get_contents(__DIR__ . '/previous.json'), true);
        $this->ensureCombo();
//        $this->ipCheck();
        if(!isset($body['code'])){
            throw new RouteException('missing property "code"', 400);
        }

        if($body['code'] == $this->combo){
            return ['access' => 'granted'];
        } else {
            throw new RouteException('unauthorized', 401);
        }
    }

    /**
     * @throws RouteException
     */
    function ipCheck(): void
    {
        $visited = $this->previous[$_SERVER['REMOTE_ADDR']] ?? false;
        if($visited && $visited['count'] > 4){
            // expired?
            if($visited['last'] > time() - 12){
                sleep(2);
                throw new RouteException('IP blocked', 401);
            }
            $this->previous[$_SERVER['REMOTE_ADDR']]['last'] = time();
        } else if($visited) {
            $this->previous[$_SERVER['REMOTE_ADDR']]['last'] = time();
            $this->previous[$_SERVER['REMOTE_ADDR']]['count']++;
        } else {
            $this->previous[$_SERVER['REMOTE_ADDR']] = [
                'last' => time(),
                'count' => 1
            ];
        }
        file_put_contents(__DIR__ . '/previous.json', json_encode($this->previous));
    }
    function ensureCombo()
    {
        if(!isset($this->previous['combo'])){
            try{
                $this->previous['combo'] = Ops::pin(4);
            } catch (\Exception $e){
                $this->previous['combo'] = 'fail';
            }

        }
        $this->combo = $this->previous['combo'];
    }
}
