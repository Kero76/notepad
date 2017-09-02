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

    use DateTime;
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
            // Instantiate a Ticket hydrate by the data get from the form (currently with initial constructor).
            $ticket = new Ticket();
            $ticketForm = $app['form.factory']->create(TicketType::class, $ticket);

            // User try to saved new ticket app.
            $ticketForm->handleRequest($request);
            if ($ticketForm->isSubmitted() && $ticketForm->isValid()) {
                // Get the current datetime to applied at releaseDate and/or lastModified attribute.
                $now = new DateTime();

                // Set the release date and the last modified at the current date time.
                $ticket->setReleaseDate($now);
                $ticket->setLastModified($now);

                // Get all labels and the label of the ticket
                $labels = $app['dao.label']->findAll();
                $labelTicket = $ticket->getLabel();

                // Loop on each and check the presence of the ticket's label on loop.
                $newLabel = true;
                foreach ($labels as $label) {
                    // If the label is found, change the value of the boolean and set the id of the ticket's label.
                    if ($label->getTitle() === $labelTicket->getTitle()) {
                        $newLabel = false;
                        $labelTicket->setId($label->getId());
                    }
                }

                // At the end of the loop, if the boolean can't change, it indicate the label is a new label.
                if ($newLabel === true) {
                    // so, the label is save in database.
                    $app['dao.label']->save($labelTicket);
                }

                // and insert ticket on Database too.
                $app['dao.ticket']->save($ticket);

                // Finally, it redirect the user on home page.
                return $app->redirect($app['url_generator']->generate('home'));
            }

            // Generate the view of the register form.
            $ticketFormView = $ticketForm->createView();
            $layout = 'forms/form-ticket.html.twig';

            return $app['twig']->render(
                $layout,
                array(
                    'ticket_form' => $ticketFormView,
                )
            );
        }

        /**
         * Get the form to add ticket render by twig with specific layout.
         *
         * @param \Silex\Application $app
         *  Silex application.
         * @param int $id
         *  Identifier of the ticket at update.
         * @param \Symfony\Component\HttpFoundation\Request $request
         *  HTTP request send by the form.
         *
         * @return mixed
         *  Twig render page.
         * @since 1.0
         * @version 1.0
         */
        public function editTicketAction(Application $app, int $id, Request $request) {
            // Instantiate a Ticket hydrate by the data get from the dao.
            $app['dao.ticket']->setLabelDao($app['dao.label']);
            $ticket = $app['dao.ticket']->find($id);
            $ticketForm = $app['form.factory']->create(TicketType::class, $ticket);

            // User try to update new ticket app.
            $ticketForm->handleRequest($request);
            if ($ticketForm->isSubmitted() && $ticketForm->isValid()) {
                // Get the current datetime to applied at releaseDate and/or lastModified attribute.
                $now = new DateTime();

                // Update the last modified with the current date time.
                $ticket->setLastModified($now);

                // Get all labels and the label of the ticket
                $labels = $app['dao.label']->findAll();
                $labelTicket = $ticket->getLabel();

                // Loop on each and check the presence of the ticket's label on loop.
                $newLabel = true;
                foreach ($labels as $label) {
                    // If the label is found, change the value of the boolean and set the id of the ticket's label.
                    if ($label->getTitle() === $labelTicket->getTitle()) {
                        $newLabel = false;
                        $labelTicket->setId($label->getId());
                    }
                }

                // At the end of the loop, if the boolean can't change, it indicate the label is a new label.
                if ($newLabel === true) {
                    // so, the label is save in database.
                    $app['dao.label']->save($labelTicket);
                }

                // and update ticket on Database too.
                $app['dao.ticket']->save($ticket);

                // Finally, it redirect the user on home page.
                return $app->redirect($app['url_generator']->generate('home'));
            }

            // Generate the view of the register form.
            $ticketFormView = $ticketForm->createView();
            $layout = 'forms/form-ticket.html.twig';

            return $app['twig']->render(
                $layout,
                array(
                    'ticket_form' => $ticketFormView,
                )
            );
        }

        /**
         * Method call to delete specific ticket.
         *
         * @param \Silex\Application $app
         *  Silex application.
         * @param int $id
         *  Identifier of the ticket at remove.
         * @param \Symfony\Component\HttpFoundation\Request $request
         *  HTTP request send by the form.
         *
         * @return mixed
         *  Twig render page.
         * @since 1.0
         * @version 1.0
         */
        public function deleteTicketAction(Application $app, int $id, Request $request) {
            // Delete the ticket.
            $app['dao.ticket']->delete($id);

            // and add flashbag to show the action was a success.
            $app['session']->getFlashbag()->add('success', 'The ticket was successfully removed.');

            // Finally, it redirect the user on home page.
            return $app->redirect($app['url_generator']->generate('home'));
        }
    }
