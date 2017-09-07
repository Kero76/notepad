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
    $app['twig.loader.filesystem']->prependPath(__DIR__ . '/../views/forms/');

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

    // Doctrine service providers.
    $app->register(new Silex\Provider\DoctrineServiceProvider());

    // Form service providers.
    $app->register(new Silex\Provider\FormServiceProvider());
    $app->register(new Silex\Provider\ValidatorServiceProvider());

    // I18N / Globalization services providers.
    $app->register(new Silex\Provider\LocaleServiceProvider());
    $app->register(
        new Silex\Provider\TranslationServiceProvider(),
        array(
            'locale' => \Notepad\Utils\WebBrowser::getClientLanguage(),
            'locale_fallback' => 'en',
            'translation.class_path' => __DIR__ . '/vender/Symfony/Component',
        )
    );
    $app->extend(
        'translator',
        function($translator, $app) {
            $translator->addLoader('yaml', new \Symfony\Component\Translation\Loader\YamlFileLoader());
            $translator->addResource('yaml', __DIR__ . '/../src/locales/fr.yml', 'fr');
            $translator->addResource('yaml', __DIR__ . '/../src/locales/en.yml', 'en');

            return $translator;
        }
    );

    // Security services providers.
    $app->register(new Silex\Provider\SessionServiceProvider());
    $app->register(
        new Silex\Provider\SecurityServiceProvider(),
        array(
            'security.firewalls' => array(
                'secured' => array(
                    'pattern' => '^/',
                    'anonymous' => true,
                    'logout' => true,
                    'form' => array(
                        'login_path' => '/login',
                        'check_path' => '/login_check',
                    ),
                    'users' => function() use ($app) {
                        return new Notepad\Dao\UserDao($app['db']);
                    },
                ),
            ),
            'security.role_hierarchy' => array(
                'ROLE_ADMIN' => array('ROLE_USER'),
            ),
            'security.access_rules' => array(
                array(
                    '^/admin',
                    'ROLE_ADMIN',
                ),
            ),
        )
    );

    // Register Dao's services providers.
    $app['dao.user'] = function($app) {
        return new Notepad\Dao\UserDao($app['db']);
    };
    $app['dao.ticket'] = function($app) {
        return new Notepad\Dao\TicketDao($app['db']);
    };
    $app['dao.label'] = function($app) {
        return new Notepad\Dao\LabelDao($app['db']);
    };
