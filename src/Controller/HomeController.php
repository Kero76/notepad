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

    use Notepad\Utils\SetUp;
    use Silex\Application;

    /**
     * Class HomeController.
     *
     * @author Nicolas GILLE
     * @package Notepad\Controller
     * @since 1.0
     * @version 1.3
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
         * @version 1.2
         */
        public function homeAction(Application $app) {
            // Set the TicketDao with an instance of LabelDao to build correctly the tickets.
            $app['dao.ticket']->setLabelDao($app['dao.label']);

            // Get all tickets and labels.
            $tickets = $app['dao.ticket']->findAll();
            $labels = $app['dao.label']->findAll();

            // Get number of ticket for each label and create array stats with number.
            $stats = array();
            foreach ($labels as $label) {
                $stats[$label->getId()] = $app['dao.ticket']->countTicketByLabel($label->getId());
            }

            // Set the layout use to render page.
            $layout = 'tickets/home.html.twig';
            $website = SetUp::setUpWebsite();
            $gravatar = SetUp::setUpGravatar();
            $theme = SetUp::setUpTheme();

            // Return the page render by Twig.
            return $app['twig']->render(
                $layout,
                array(
                    'tickets' => $tickets,
                    'labels' => $labels,
                    'stats' => $stats,
                    'website' => $website,
                    'gravatar' => $gravatar,
                    'theme' => $theme,
                )
            );
        }

        /**
         * Get all tickets archives on the app.
         *
         * @param \Silex\Application $app
         *  Silex application.
         *
         * @return mixed
         *  Twig render page.
         * @since 1.1
         * @version 1.2
         */
        public function archivesAction(Application $app) {
            // Set the TicketDao with an instance of LabelDao to build tickets.
            $app['dao.ticket']->setLabelDao($app['dao.label']);

            // Get all archives tickets and labels.
            $tickets = $app['dao.ticket']->findAllArchives();
            $labels = $app['dao.label']->findAll();

            // Set the layout use to render the page.
            $layout = 'tickets/mark.html.twig';
            $title = 'archive';
            $website = SetUp::setUpWebsite();
            $gravatar = SetUp::setUpGravatar();
            $theme = SetUp::setUpTheme();

            // Return the page render by Twig.
            return $app['twig']->render(
                $layout,
                array(
                    'tickets' => $tickets,
                    'labels' => $labels,
                    'website' => $website,
                    'gravatar' => $gravatar,
                    'theme' => $theme,
                    'title' => $title,
                )
            );
        }

        /**
         * Get all tickets archives on the app.
         *
         * @param \Silex\Application $app
         *  Silex application.
         *
         * @return mixed
         *  Twig render page.
         * @since 1.1
         * @version 1.2
         */
        public function starsAction(Application $app) {
            // Set the TicketDao with an instance of LabelDao to build tickets.
            $app['dao.ticket']->setLabelDao($app['dao.label']);

            // Get all starred tickets and labels.
            $tickets = $app['dao.ticket']->findAllStarred();
            $labels = $app['dao.label']->findAll();

            // Set the layout use to render the page.
            $layout = 'tickets/mark.html.twig';
            $title = 'star';
            $website = SetUp::setUpWebsite();
            $gravatar = SetUp::setUpGravatar();
            $theme = SetUp::setUpTheme();

            // Return the page render by Twig.
            return $app['twig']->render(
                $layout,
                array(
                    'tickets' => $tickets,
                    'labels' => $labels,
                    'website' => $website,
                    'gravatar' => $gravatar,
                    'theme' => $theme,
                    'title' => $title,
                )
            );
        }
    }
