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
    class TicketDao extends AbstractDAO {

        /**
         * Get all tickets from the database.
         *
         * @return array
         *  All tickets found on database.
         * @since 1.0
         * @version 1.0
         */
        public function findAll() {
            $sql = 'SELECT * FROM np_tickets ORDER BY ticket_id DESC';
            $result =
                $this->getDb()
                     ->fetchAll();

            $tickets = array();
            foreach ($result as $row) {
                $id = $row['ticket_id'];
                $tickets[$id] = $this->buildObject($row);
            }

            return $tickets;
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
            $ticket->setId($data['ticket_id']);
            $ticket->setTitle($data['ticket_title']);
            $ticket->setContent($data['ticket_content']);

            return $ticket;
        }
    }
