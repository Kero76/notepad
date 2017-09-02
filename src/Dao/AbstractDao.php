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

    use Doctrine\DBAL\Driver\Connection;

    /**
     * Class AbstractDao.
     *
     * @author Nicolas GILLE
     * @package NotePad\DAO
     * @since 1.0
     * @version 1.0
     */
    abstract class AbstractDao {

        /**
         * Database connection.
         *
         * @var \Doctrine\DBAL\Driver\Connection
         * @since 1.0
         */
        private $db;

        /**
         * AbstractDao constructor.
         *
         * @param \Doctrine\DBAL\Driver\Connection $db
         *  Database access connection.
         *
         * @since 1.0
         * @version 1.0
         */
        public function __construct(Connection $db) {
            $this->db = $db;
        }

        /**
         * Get the database connection.
         *
         * @return \Doctrine\DBAL\Driver\Connection
         *  Return the database connection.
         * @since 1.0
         * @version 1.0
         */
        protected function getDb(): Connection {
            return $this->db;
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
        protected abstract function buildEntity(array $data);
    }
