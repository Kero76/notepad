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

    declare(strict_types=1);

    namespace Notepad\Controller;

    use Silex\Application;

    /**
     * Class HomeController.
     *
     * @author Nicolas GILLE
     * @package Notepad\Controller
     * @since 1.0
     * @version 1.0
     */
    class HomeController {

        /**
         * Get the home page render by twig with specific layout.
         *
         * @param \Silex\Application $app
         *  Silex application.
         *
         * @return mixed
         *  Twig render page.
         * @since 1.0
         * @version 1.0
         */
        public function homeAction(Application $app) {
            $tickets = $app['dao.ticket']->findAll();
            $layout = 'home.html.twig';

            return $app['twig']->render(
                $layout,
                array(
                    'tickets' => $tickets,
                )
            );
        }
    }
