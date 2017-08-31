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

    namespace Notepad\Entity;

    /**
     * Class Label
     *
     * @author Nicolas GILLE
     * @package Notepad\Entity
     * @since 0.1
     * @version 1.0
     */
    class Label {

        /**
         * @var integer
         * @since 0.1
         */
        private $id;

        /**
         * @var string
         * @since 0.1
         */
        private $title;

        /**
         * @return int
         * @since 0.1
         * @version 1.0
         */
        public function getId(): int {
            return $this->id;
        }

        /**
         * @param int $id
         *
         * @since 0.1
         * @version 1.0
         */
        public function setId(int $id) {
            $this->id = $id;
        }

        /**
         * @return string
         * @since 0.1
         * @version 1.0
         */
        public function getTitle(): string {
            return $this->title;
        }

        /**
         * @param string $title
         *
         * @since 0.1
         * @version 1.0
         */
        public function setTitle(string $title) {
            $this->title = $title;
        }

    }
