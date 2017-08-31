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

    use Notepad\Entity\Label;

    /**
     * Class LabelDao
     *
     * @author Nicolas GILLE
     * @package Notepad\Dao
     * @since 0.1
     * @version 1.0
     */
    class LabelDao extends AbstractDao {

        /**
         * Return a specific ticket with his id.
         *
         * @param int $id
         *  Id of the ticket.
         *
         * @return \Notepad\Entity\Label
         *  An instance of Ticket.
         * @throws \Exception
         *  Throw an exception when fetchAssoc() return nothing.
         * @since 0.1
         * @version 1.0
         */
        public function find(int $id): Label {
            // Create SQL request
            $sql = 'SELECT * FROM np_labels WHERE label_id = ?';

            // Execute request and get object.
            $row = $this->getDb()
                        ->fetchAssoc($sql, array($id));

            if ($row) {
                return $this->buildEntity($row);
            } else {
                throw new \Exception('No Label matching id ' . $id);
            }
        }

        /**
         * Get all labels from the database.
         *
         * @return array
         *  All labels found on database.
         * @since 1.0
         * @version 1.0
         */
        public function findAll(): array {
            // Create SQL request
            $sql = 'SELECT * FROM np_labels ORDER BY label_id ASC';

            // Execute request and get objects.
            $result = $this->getDb()
                           ->fetchAll($sql);

            $labels = array();
            foreach ($result as $row) {
                // Build label
                $id = $row['label_id'];
                $labels[$id] = $this->buildObject($row);
            }

            return $labels;
        }

        /**
         * Build the specific object from the Model.
         *
         * @param array $data
         *  An array to fill object get from Database.
         *
         * @return mixed
         *  Return the object who corresponding to the DAO.
         * @since 1.0
         * @version 1.0
         */
        protected function buildEntity(array $data) {
            $label = new Label();
            $label->setId($data['label_id']);
            $label->setTitle($data['label_title']);

            return $label;
        }
    }