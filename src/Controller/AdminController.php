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

    use Notepad\Entity\Ticket;
    use Notepad\Form\TicketType;
    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * Class AdminController.
     *
     * @author Nicolas GILLE
     * @package Notepad\Controller
     * @since 1.0
     * @version 1.0
     */
    class AdminController {

        /**
         * Get the form to add ticket render by twig with specific layout.
         *
         * @param \Silex\Application $app
         *  Silex application.
         * @param \Symfony\Component\HttpFoundation\Request $request
         *  HTTP request send by the form.
         *
         * @return mixed
         *  Twig render page.
         * @since 1.0
         * @version 1.0
         */
        public function addTicketAction(Application $app, Request $request) {
            // Instantiate a User hydrate by the data get from the registration form.
            $ticket = new Ticket();
            $ticketForm = $app['form.factory']->create(TicketType::class, $ticket);

            // User try to register on website.
            $ticketForm->handleRequest($request);
            if ($ticketForm->isSubmitted() && $ticketForm->isValid()) {
                // Get all labels and label for the ticket
                $labels = $app['dao.label']->findAll();
                $labelTicket = $ticket->getLabel();

                // and check if current title doesn't exist on list,
                if (!in_array($labelTicket->getTitle(), $labels)) {
                    // then, insert new label on Database.
                    $app['dao.label']->save($labelTicket);
                } else {
                    // Or else by looping on all labels
                    foreach ($labels as $l) {
                        // and update id of the label present on ticket.
                        if ($l->getTitle() === $labelTicket->getTitle()) {
                            $labelTicket->setId($l->getId());
                        }
                    }
                }

                // and insert ticket on Database too.
                $app['dao.ticket']->save($ticket);

                // Finally, it redirect the user on home page.
//                return $app->redirect($app['url_generator']->generate('home'));
            }

            // Generate the view of the register form.
            $ticketFormView = $ticketForm->createView();
            $layout = 'forms/add-ticket.html.twig';

            return $app['twig']->render(
                $layout,
                array(
                    'ticket_form' => $ticketFormView,
                )
            );
        }
    }
