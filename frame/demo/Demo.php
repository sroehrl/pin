<?php
/**
 * Created by PhpStorm.
 * User: sroehrl
 * Date: 2/4/2019
 * Time: 1:36 PM
 */

namespace Neoan3\Frame;

use Neoan3\Core\Serve;
use Neoan3\Provider\MySql\Database;
use Neoan3\Provider\MySql\DatabaseWrapper;

/**
 * Class Demo
 * @package Neoan3\Frame
 */
class Demo extends Serve
{

    /**
     * Name your credentials
     * @var string
     */
    private string $dbCredentials = 'neoan3_db';
    /**
     * @var Database|DatabaseWrapper
     */
    public Database $db;

    /**
     * Demo constructor.
     * @param Database|null $db
     * @throws \Exception
     */
    function __construct(Database $db = null)
    {
        parent::__construct();
        if($db){
            $this->db = $db;
        } else {


        }
    }

    /**
     * @param $model
     * @return mixed
     */
    function model($model)
    {
        $model::init($this->db);
        return $model;
    }

    /**
     * @return array
     */
    function constants()
    {
        return [
            'base' => [base],
            'link' => [
                [
                    'sizes' => '32x32',
                    'type' => 'image/png',
                    'rel' => 'icon',
                    'href' => 'asset/neoan-favicon.png'
                ]
            ],
            'js' => [
                ['src' => 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js'],
                ['src' => 'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js']
            ],
            'stylesheet' => [
                '' . base . 'frame/demo/demo.css',
                'https://cdn.jsdelivr.net/npm/gaudiamus-css@1.1.0/css/gaudiamus.min.css',
            ]
        ];
    }
}
