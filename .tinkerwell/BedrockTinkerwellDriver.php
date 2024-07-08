<?php

// @phpstan-ignore-file

use Illuminate\Support\Collection;

class BedrockTinkerwellDriver extends TinkerwellDriver
{
    public function canBootstrap($projectPath)
    {
        return "{$projectPath}/web/index.php";
    }

    public function bootstrap($projectPath)
    {
        // Mirrors the contents of `wp-config.php`.
        require_once "{$projectPath}/vendor/autoload.php";
        require_once "{$projectPath}/config/application.php";
        require_once ABSPATH . '/wp-settings.php';
    }

    public function getAvailableVariables()
    {
        return [
            '__options'  => wp_load_alloptions(),
            '__posts'    => (new WP_Query(['posts_per_page' => -1]))->get_posts(),
            '__sage'     => function ($service = null) {
                return app($service);
            },
            'collection' => Collection::class,
        ];
    }
}