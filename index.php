<?php

require_once './vendor/autoload.php';

use JsonContainer\Container;

$container = Container::getInstance();


class Test {
	private $id;
	public function __construct($id) {
		$this->id = $id;
	}
}




class Cache {

    public function __construct(Test $test) {
    }

}

$container->singleton("cache",Cache::class);

$container->Test = function () {
	return new Test(333);
};

var_dump($container->cache);
var_dump($container->isAlias("cache"));

/**

**/
