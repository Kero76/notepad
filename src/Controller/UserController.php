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
    use Notepad\Form\UserType;
    use Notepad\Utils\SetUp;
    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

    /**
     * Class UserController
     *
     * @author Nicolas GILLE
     * @package Notepad\Controller
     * @since 0.6
     * @version 1.0
     */
    class UserController {

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
         * @version 1.0
         */
        public function loginAction(Application $app, Request $request) {
            // Set layout, settings and gravatar.
            $layout = 'forms/login.html.twig';
            $website = SetUp::setUpWebsite();
            $gravatar = SetUp::setUpGravatar();
            $theme = SetUp::setUpTheme();

            // Add flashbag to confirm sign up action.
            $app['session']->getFlashbag()
                           ->add('success', $app['translator']->trans('log_in_success'));

            return $app['twig']->render(
                $layout,
                array(
                    'error' => $app['security.last_error']($request),
                    'last_username' => $app['session']->get('_security.last_username'),
                    'website' => $website,
                    'gravatar' => $gravatar,
                    'theme' => $theme,
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
         * @version 1.0
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

                // Generate token to connect user after registration.
                $token = new UsernamePasswordToken($user, null, 'secured', $user->getRoles());
                $app['security.token_storage']->setToken($token);

                return $app->redirect($app['url_generator']->generate('home'));
            }

            // Generate the view of the register form.
            $signUpFormView = $signUpForm->createView();
            $layout = 'forms/sign-up.html.twig';
            $website = SetUp::setUpWebsite();
            $gravatar = SetUp::setUpGravatar();
            $theme = SetUp::setUpTheme();

            return $app['twig']->render(
                $layout,
                array(
                    'error' => $app['security.last_error']($request),
                    'last_username' => $app['session']->get('_security.last_username'),
                    'sign_up_form' => $signUpFormView,
                    'website' => $website,
                    'gravatar' => $gravatar,
                    'theme' => $theme,
                )
            );
        }

        /**
         * Get user profile.
         *
         * @param \Silex\Application $app
         *  Silex Application.
         * @param int $id
         *  Id of the user.
         *
         * @since 1.0
         * @version 1.0
         */
        public function userProfileAction(Application $app, int $id) {
            // Get user info.
            $user = $app['dao.user']->find($id);

            // Set up all necessary object to render view.
            $layout = 'users/user.html.twig';
            $website = SetUp::setUpWebsite();
            $gravatar = SetUp::setUpGravatar();
            $theme = SetUp::setUpTheme();
            $gravatarProfile = SetUp::setUpGravatar();
            $gravatarProfile->setSize(128);

            return $app['twig']->render(
                $layout,
                array(
                    'user' => $user,
                    'gravatar_profile' => $gravatarProfile,
                    'website' => $website,
                    'gravatar' => $gravatar,
                    'theme' => $theme,
                )
            );
        }

        /**
         * Edit user profile.
         *
         * @param \Silex\Application $app
         *  Silex Application.
         * @param \Symfony\Component\HttpFoundation\Request $request
         *  Request who contains user information.
         * @param int $id
         *  Id of the user.
         *
         * @return mixed
         *  The form render or redirect user on homepage.
         * @since 1.0
         * @version 1.0
         */
        public function userProfileEditAction(Application $app, Request $request, int $id) {
            // Get user with id and create user form.
            $user = $app['dao.user']->find($id);
            $userForm = $app['form.factory']->create(UserType::class, $user);

            // User try to update information.
            $userForm->handleRequest($request);
            if ($userForm->isSubmitted() && $userForm->isValid()) {
                // Update user on Database.
                $app['dao.user']->save($user);

                // and add flashbag to show the action was a success.
                $app['session']->getFlashbag()
                               ->add('success', $app['translator']->trans('user_update'));

                // Finally, it redirect the user on home page.
                return $app->redirect($app['url_generator']->generate('home'));
            }

            // Generate the view of the update user form.
            $userFormView = $userForm->createView();
            $layout = 'forms/form-user.html.twig';
            $website = SetUp::setUpWebsite();
            $gravatar = SetUp::setUpGravatar();
            $theme = SetUp::setUpTheme();

            return $app['twig']->render(
                $layout,
                array(
                    'user_form' => $userFormView,
                    'website' => $website,
                    'gravatar' => $gravatar,
                    'theme' => $theme,
                )
            );
        }
    }
