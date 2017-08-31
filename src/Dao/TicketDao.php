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
     * @version 1.0
     */
    class TicketDao extends AbstractDao {

        /**
         * @var \Notepad\Dao\LabelDao
         * @since 0.1
         */
        private $labelDao;

        /**
         * @param \Notepad\Dao\LabelDao $labelDao
         *
         * @since 0.1
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
         * @since 0.1
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
                    $label = $this->labelDao->find($labelId);
                    $ticket->setLabel($label);
                }
            } else {
                throw new \Exception('No Ticket matching id ' . $id);
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
         * Save label in Database.
         *
         * @param \Notepad\Entity\Ticket $ticket
         *  New ticket at saved in Database.
         * @since 0.1
         * @version 1.0
         */
        public function save(Ticket $ticket) {
            $ticketData = array(
                'ticket_title' => $ticket->getTitle(),
                'ticket_content' => $ticket->getContent(),
                'fk_label_id' => $ticket->getLabel()->getId(),
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

            return $ticket;
        }
    }
