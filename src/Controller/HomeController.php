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

    use Notepad\Entity\User;
    use Notepad\Form\SignUpType;
    use Notepad\Utils\Settings;
    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * Class HomeController.
     *
     * @author Nicolas GILLE
     * @package Notepad\Controller
     * @since 1.0
     * @version 1.2
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
         * @version 1.1
         */
        public function homeAction(Application $app) {
            // Set the TicketDao with an instance of LabelDao to build correctly the tickets.
            $app['dao.ticket']->setLabelDao($app['dao.label']);

            // Get all tickets and labels.
            $tickets = $app['dao.ticket']->findAll();
            $labels = $app['dao.label']->findAll();

            // Set the layout use to render page.
            $layout = 'tickets/home.html.twig';

            // Return the page render by Twig.
            return $app['twig']->render(
                $layout,
                array(
                    'tickets' => $tickets,
                    'labels' => $labels,
                    'settings' => new Settings(),
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
         * @version 1.1
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

            // Return the page render by Twig.
            return $app['twig']->render(
                $layout,
                array(
                    'tickets' => $tickets,
                    'labels' => $labels,
                    'settings' => new Settings(),
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
         * @version 1.1
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

            // Return the page render by Twig.
            return $app['twig']->render(
                $layout,
                array(
                    'tickets' => $tickets,
                    'labels' => $labels,
                    'settings' => new Settings(),
                    'title' => $title,
                )
            );
        }

        /**
         * Login page.
         *
         * @param \Silex\Application $app
         *  Silex Application.
         * @param \Symfony\Component\HttpFoundation\Request $request
         *  Request who contains parameter get from form.
         *
         * @return mixed
         *  Twig render page.
         * @since 1.0
         * @version 1.1
         */
        public function loginAction(Application $app, Request $request) {
            $layout = 'forms/login.html.twig';

            // Add flashbag to confirm sign up action.
            $app['session']->getFlashbag()
                           ->add('success', $app['translator']->trans('log_in_success'));

            return $app['twig']->render(
                $layout,
                array(
                    'error' => $app['security.last_error']($request),
                    'last_username' => $app['session']->get('_security.last_username'),
                    'settings' => new Settings(),
                )
            );
        }

        /**
         * Get specific ticket on the app.
         *
         * @param \Silex\Application $app
         *  Silex application.
         * @param int $id
         *  Id of the ticket at displayed.
         *
         * @return mixed
         *  Twig render page.
         * @since 1.1
         * @version 1.1
         */
        public function ticketAction(Application $app, int $id) {
            // Set the TicketDao with an instance of LabelDao to build tickets.
            $app['dao.ticket']->setLabelDao($app['dao.label']);

            // Get ticket.
            $ticket = $app['dao.ticket']->find($id);

            // Set the layout use to render the page.
            $layout = 'tickets/ticket.html.twig';

            // Return the page render by Twig.
            return $app['twig']->render(
                $layout,
                array(
                    'ticket' => $ticket,
                    'settings' => new Settings(),
                )
            );
        }

        /**
         * Sign Up page.
         *
         * @param \Silex\Application $app
         *  Silex Application
         * @param \Symfony\Component\HttpFoundation\Request $request
         *  HTTP request with all information get from form.
         *
         * @return mixed
         *  Twig render page.
         * @since 1.0
         * @version 1.1
         */
        public function signUpAction(Application $app, Request $request) {
            // Instantiate a User hydrate by the data get from the registration form.
            $user = new User();
            $signUpForm = $app['form.factory']->create(SignUpType::class, $user);

            // User try to register on website.
            $signUpForm->handleRequest($request);
            if ($signUpForm->isSubmitted() && $signUpForm->isValid()) {
                // Generate a random salt value.
                $salt = substr(md5(time() . ""), 0, 23);
                $user->setSalt($salt);
                $plainPassword = $user->getPassword();

                // Find the default encoder
                $encoder = $app['security.encoder.bcrypt'];

                // Compute the encoded password
                $password = $encoder->encodePassword($plainPassword, $user->getSalt());
                $user->setPassword($password);
                $user->setRole('ROLE_ADMIN');

                // Add flashbag to confirm sign up action.
                $app['session']->getFlashbag()
                               ->add('success', $app['translator']->trans('sign_up_success'));

                // Save the user on database and redirect the user on home page.
                $app['dao.user']->save($user);

                return $app->redirect($app['url_generator']->generate('home'));
            }

            // Generate the view of the register form.
            $signUpFormView = $signUpForm->createView();
            $layout = 'forms/sign-up.html.twig';

            return $app['twig']->render(
                $layout,
                array(
                    'error' => $app['security.last_error']($request),
                    'last_username' => $app['session']->get('_security.last_username'),
                    'sign_up_form' => $signUpFormView,
                    'settings' => new Settings(),
                )
            );
        }
    }
