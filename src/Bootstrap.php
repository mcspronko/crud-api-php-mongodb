<?php

namespace App;

use DevCoder\DotEnv;
use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Slim\App;

class Bootstrap
{
    private App $app;

    public function configure(string $definition = '', $envFilePath = null)
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions($definition);

        (new DotEnv($envFilePath))->load();
        $container = $builder->build();

        $this->app = Bridge::create($container);

        $container->set('app', $this->app);

        /** @var Router $router */
        $router = $container->get(Router::class);
        $router->configure($this->app);
    }

    public function run(): void
    {
        $this->app->run();
    }
}
