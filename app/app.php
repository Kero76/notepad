<?php
    /**
     * Notepad.
     * Copyright (C) 2017 Nicolas GILLE
     *
     * This program is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     *
     * This program is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     * GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License
     * along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    use Symfony\Component\Debug\ErrorHandler;
    use Symfony\Component\Debug\ExceptionHandler;
    use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

    declare(strict_types=1);

    // Register global errors and exceptions handler.
    ErrorHandler::register();
    ExceptionHandler::register();

    // Register Twig services providers.
    $app->register(
        new Silex\Provider\TwigServiceProvider(),
        array(
            'twig.path' => __DIR__ . '/../views/',
        )
    );

    // Extends Twig with some services.
    $app->extend(
        'twig',
        function(Twig_Environment $twig, $app) {
            $twig->addExtension(new Twig_Extensions_Extension_Intl());
            $twig->addExtension(new Twig_Extensions_Extension_Text());
            return $twig;
        }
    );

    // Register Asset service provider.
    $app->register(
        new Silex\Provider\AssetServiceProvider(),
        array(
            'assets.version' => 'v1',
        )
    );

    // Register Doctrine ORM service provider.
    $app->register(
        new DoctrineOrmServiceProvider,
        array(
            'orm.proxies_dir' => 'src/App/Entity/Proxy',
            'orm.auto_generate_proxies' => $app['debug'],
            'orm.em.options' => array(
                'mappings' => array(
                    array(
                        'type' => 'annotation',
                        'namespace' => 'Notepad\\Entity\\',
                        'path' => 'src/Entity',
                        'use_simple_annotation_reader' => false,
                    ),
                ),
            ),
        )
    );
