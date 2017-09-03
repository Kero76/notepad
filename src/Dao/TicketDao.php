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

    namespace Notepad\Dao;

    use Notepad\Entity\Ticket;

    /**
     * Class TicketDao
     *
     * @author Nicolas GILLE
     * @package Notepad\Dao
     * @since 1.0
     * @version 1.2
     */
    class TicketDao extends AbstractDao {

        /**
         * @var \Notepad\Dao\LabelDao
         * @since 1.0
         */
        private $labelDao;

        /**
         * @param \Notepad\Dao\LabelDao $labelDao
         *
         * @since 1.0
         * @version 1.0
         */
        public function setLabelDao(LabelDao $labelDao) {
            $this->labelDao = $labelDao;
        }

        /**
         * Return a specific ticket with his id.
         *
         * @param int $id
         *  Id of the ticket.
         *
         * @return \Notepad\Entity\Ticket
         *  An instance of Ticket.
         * @throws \Exception
         *  Throw an exception when fetchAssoc() return nothing.
         * @since 1.0
         * @version 1.0
         */
        public function find(int $id): Ticket {
            // Create SQL request
            $sql = 'SELECT * FROM np_tickets WHERE ticket_id = ?';

            // Execute request and get object.
            $row = $this->getDb()
                        ->fetchAssoc($sql, array($id));

            // If row exist.
            if ($row) {
                // Build ticket
                $ticket = $this->buildEntity($row);

                // If fk_label_id exist, set new label object.
                if (array_key_exists('fk_label_id', $row)) {
                    $labelId = $row['fk_label_id'];
                    $label = $this->labelDao->find(intval($labelId));
                    $ticket->setLabel($label);
                }

                // Return ticket build.
                return $ticket;
            } else {
                throw new \Exception('No Ticket matching id ' . $id);
            }
        }

        /**
         * Count the number of ticket for the label.
         *
         * @param int $labelId
         *  Id of the label.
         *
         * @return int The number of ticket for the label.
         * The number of ticket for the label.
         * @throws \Exception
         * @since 1.1
         * @version 1.0
         */
        public function countTicketByLabel(int $labelId) {
            // Create SQL request.
            $sql = 'SELECT COUNT(*) AS "count" FROM np_tickets WHERE fk_label_id = ?';

            // Execute request and get result.
            $row = $this->getDb()
                        ->fetchAssoc($sql, array($labelId));

            // If row exist,
            if ($row) {
                // then return result.
                return $row['count'];
            } else {
                // else throw an exception.
                throw new \Exception('An error occurred during process.');
            }
        }

        /**
         * Get all tickets from the database.
         *
         * @return array
         *  All tickets found on database.
         * @since 1.0
         * @version 1.0
         */
        public function findAll(): array {
            // Create SQL request.
            $sql = 'SELECT * FROM np_tickets ORDER BY fk_label_id ASC, ticket_id DESC';

            // Execute request and get object.
            $result = $this->getDb()
                           ->fetchAll($sql);

            $tickets = array();
            foreach ($result as $row) {
                // Build Ticket
                $id = $row['ticket_id'];
                $tickets[$id] = $this->buildEntity($row);

                // If fk_label_id exist, set new label object.
                if (array_key_exists('fk_label_id', $row)) {
                    $labelId = intval($row['fk_label_id']);
                    $label = $this->labelDao->find($labelId);
                    $tickets[$id]->setLabel($label);
                }
            }

            return $tickets;
        }

        /**
         * Get all tickets are archive in notepad.
         *
         * @return array
         *  An array with all tickets archives.
         * @since 1.2
         * @version 1.0
         */
        public function findAllArchives() : array {
            // Create SQL request.
            $sql = 'SELECT * FROM np_tickets WHERE ticket_is_archive = TRUE ORDER BY fk_label_id ASC, ticket_id DESC';

            // Execute request and get object.
            $result = $this->getDb()
                           ->fetchAll($sql);

            $tickets = array();
            foreach ($result as $row) {
                // Build Ticket
                $id = $row['ticket_id'];
                $tickets[$id] = $this->buildEntity($row);

                // If fk_label_id exist, set new label object.
                if (array_key_exists('fk_label_id', $row)) {
                    $labelId = intval($row['fk_label_id']);
                    $label = $this->labelDao->find($labelId);
                    $tickets[$id]->setLabel($label);
                }
            }

            return $tickets;
        }

        /**
         * Get all tickets starred in notepad.
         *
         * @return array
         *  An array with all tickets starred.
         * @since 1.2
         * @version 1.0
         */
        public function findAllStarred() : array {
            // Create SQL request.
            $sql = 'SELECT * FROM np_tickets WHERE ticket_is_star = TRUE ORDER BY fk_label_id ASC, ticket_id DESC';

            // Execute request and get object.
            $result = $this->getDb()
                           ->fetchAll($sql);

            $tickets = array();
            foreach ($result as $row) {
                // Build Ticket
                $id = $row['ticket_id'];
                $tickets[$id] = $this->buildEntity($row);

                // If fk_label_id exist, set new label object.
                if (array_key_exists('fk_label_id', $row)) {
                    $labelId = intval($row['fk_label_id']);
                    $label = $this->labelDao->find($labelId);
                    $tickets[$id]->setLabel($label);
                }
            }

            return $tickets;
        }

        /**
         * Save or update ticket in Database.
         *
         * @param \Notepad\Entity\Ticket $ticket
         *  New ticket at save or update in Database.
         *
         * @since 1.
         * @version 1.0
         */
        public function save(Ticket $ticket) {
            $ticketData = array(
                'ticket_title' => $ticket->getTitle(),
                'ticket_content' => $ticket->getContent(),
                'ticket_release_date' => $ticket->getReleaseDate(),
                'ticket_last_modified' => $ticket->getLastModified(),
                'ticket_is_archive' => $ticket->isArchive(),
                'ticket_is_star' => $ticket->isStar(),
                'fk_label_id' => $ticket->getLabel()
                                        ->getId(),
            );

            // Update Ticket previously save on system or insert it.
            if ($ticket->getId() !== -1) {
                // The ticket must be update with new data.
                $this->getDb()
                     ->update('np_tickets', $ticketData, array('ticket_id' => $ticket->getId()));
            } else {
                // The ticket has never saved : insert it.
                $this->getDb()
                     ->insert('np_tickets', $ticketData);
            }
        }

        /**
         * Delete the ticket specified by the id.
         *
         * @param int $id
         *  Identifier of the ticket at delete.
         *
         * @since 1.1
         * @version 1.0
         */
        public function delete(int $id) {
            $this->getDb()
                 ->delete('np_tickets', array('ticket_id' => $id));
        }

        /**
         * Build the specific object from the Model.
         *
         * @param array $data
         *  An array to fill object get from Database.
         *
         * @return \Notepad\Entity\Ticket
         *  Return the ticket to build with data.
         * @since 1.0
         * @version 1.0
         */
        protected function buildEntity(array $data) {
            $ticket = new Ticket();
            $ticket->setId(intval($data['ticket_id']));
            $ticket->setTitle($data['ticket_title']);
            $ticket->setContent($data['ticket_content']);
            $ticket->setReleaseDate(new \DateTime($data['ticket_release_date']));
            $ticket->setLastModified(new \DateTime($data['ticket_last_modified']));
            $ticket->setIsArchive(boolval($data['ticket_is_archive']));
            $ticket->setIsStar(boolval($data['ticket_is_star']));

            return $ticket;
        }
    }
