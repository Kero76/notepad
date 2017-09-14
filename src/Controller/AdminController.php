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
    use Notepad\Entity\Label;
    use Notepad\Entity\Settings;
    use Notepad\Entity\Ticket;
    use Notepad\Form\TicketType;
    use Notepad\Utils\SetUp;
    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * Class AdminController.
     *
     * @author Nicolas GILLE
     * @package Notepad\Controller
     * @since 0.1
     * @version 1.3
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
         * @version 1.2
         */
        public function addTicketAction(Application $app, Request $request) {
            // Instantiate a Ticket hydrate by the data get from the form (currently with initial constructor).
            $ticket = new Ticket();
            if ($request->get('label_title') !== null) {
                $label = new Label();
                $label->setTitle($request->get('label_title'));
                $ticket->setLabel($label);
            }
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
                    // so, the label is save in database,
                    $app['dao.label']->save($labelTicket);

                    // and add flashbag to show the label was create.
                    $app['session']->getFlashbag()
                                   ->add('success', $app['translator']->trans('label_creation'));
                }

                // and insert ticket on Database too.
                $app['dao.ticket']->save($ticket);

                // and add flashbag to show the action was a success.
                $app['session']->getFlashbag()
                               ->add('success', $app['translator']->trans('ticket_creation'));

                // Finally, it redirect the user on home page.
                return $app->redirect($app['url_generator']->generate('home'));
            }

            // Generate the view of the register form.
            $ticketFormView = $ticketForm->createView();
            $layout = 'forms/form-ticket.html.twig';
            $title = 'add_ticket_title';
            $settings = Settings::getInstance();
            $gravatar = SetUp::setUpGravatar();
            $theme = SetUp::setUpTheme();

            return $app['twig']->render(
                $layout,
                array(
                    'ticket_form' => $ticketFormView,
                    'settings' => $settings,
                    'gravatar' => $gravatar,
                    'theme' => $theme,
                    'title' => $title,
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
         * @since 1.1
         * @version 1.2
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
                    // so, the label is save in database,
                    $app['dao.label']->save($labelTicket);

                    // and add flashbag to show the label was create.
                    $app['session']->getFlashbag()
                                   ->add('success', $app['translator']->trans('label_creation'));
                }

                // and update ticket on Database too.
                $app['dao.ticket']->save($ticket);

                // Remove useless label if necessary.
                $this->removeUselessLabel($app);

                // and add flashbag to show the action was a success.
                $app['session']->getFlashbag()
                               ->add('success', $app['translator']->trans('ticket_update'));

                // Finally, it redirect the user on home page.
                return $app->redirect($app['url_generator']->generate('home'));
            }

            // Generate the view of the register form.
            $ticketFormView = $ticketForm->createView();
            $layout = 'forms/form-ticket.html.twig';
            $title = 'edit_ticket_title';
            $settings =
            $settings = Settings::getInstance();
            $gravatar = SetUp::setUpGravatar();
            $theme = SetUp::setUpTheme();

            return $app['twig']->render(
                $layout,
                array(
                    'ticket_form' => $ticketFormView,
                    'settings' => $settings,
                    'gravatar' => $gravatar,
                    'theme' => $theme,
                    'title' => $title,
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
         *
         * @return mixed
         *  Twig render page.
         * @since 1.1
         * @version 1.1
         */
        public function deleteTicketAction(Application $app, int $id) {
            // Get ticket to check if he's mark as archive.
            $app['dao.ticket']->setLabelDao($app['dao.label']);
            $ticket = $app['dao.ticket']->find($id);
            if ($ticket->isArchive() === true) {
                $app['session']->getFlashbag()
                               ->add('errors', $app['translator']->trans('ticket_no_deleted'));
            } else {
                // Delete the ticket.
                $app['dao.ticket']->delete($id);

                // and add flashbag to show the action was a success.
                $app['session']->getFlashbag()
                               ->add('success', $app['translator']->trans('ticket_delete'));

                // Remove useless label if necessary.
                $this->removeUselessLabel($app);
            }

            // Finally, it redirect the user on home page.
            return $app->redirect($app['url_generator']->generate('home'));
        }

        /**
         * Toggle star status of the specific ticket.
         *
         * @param \Silex\Application $app
         *  Silex application.
         * @param int $id
         *  Id of the ticket to toggle star status.
         *
         * @return mixed
         *  Redirect user on home page.
         * @since 1.2
         * @version 1.0
         */
        public function toggleStarAction(Application $app, int $id) {
            // Get ticket.
            $app['dao.ticket']->setLabelDao($app['dao.label']);
            $ticket = $app['dao.ticket']->find($id);

            // Toggle isStar attribute,
            $toggleStar = !$ticket->isStar();
            $ticket->setIsStar($toggleStar);

            // and update ticket on Database.
            $app['dao.ticket']->save($ticket);

            // Finally, it redirect the user on home page.
            return $app->redirect($app['url_generator']->generate('home'));
        }

        /**
         * Remove useless label.
         *
         * An useless label is a label doesn't contain any ticket on it.
         * So, to avoid problem with view, it remove automatically the label who have 0 ticket.
         * This method is call when I update or remove a ticket.
         * In fact, when I delete a ticket, it possibly to delete the last ticket of the label, so I delete it too.
         * For the update, I can change the label of the ticket and for the same reason of deletion, we can delete
         * label too.
         *
         * @param \Silex\Application $app
         *  Silex application.
         *
         * @access private
         * @since 1.1
         * @version 1.1
         */
        private function removeUselessLabel(Application $app) {
            // Get all labels
            $labels = $app['dao.label']->findAll();

            // For each label, call the method countTicketByLabel() to check if the label have one ticket or more.
            foreach ($labels as $label) {
                $labelId = $label->getId();
                $result = $app['dao.ticket']->countTicketByLabel($labelId);

                // If result equal 0,
                if (intval($result) === 0) {
                    // then I delete the label because it's empty.
                    $app['dao.label']->delete($labelId);

                    // and add flashbag to show the label was removed.
                    $app['session']->getFlashbag()
                                   ->add('success', $app['translator']->trans('label_delete'));
                }
            }
        }
    }
