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
     * Class Theme.
     *
     * @author Nicolas GILLE
     * @package Notepad\Entity
     * @since 0.6
     * @version 1.0
     */
    class Theme {

        /**
         * @var string
         * @since 1.0
         */
        private $name;

        /**
         * @var string
         * @since 1.0
         */
        private $link;

        /**
         * @var string
         * @since 1.0
         */
        private $integrity;

        /**
         * Theme constructor.
         *
         * @param string $name
         * @param string $link
         * @param string $integrity
         *
         * @since 1.0
         * @version 1.0
         */
        public function __construct(string $name, string $link, string $integrity) {
            $this->name = $name;
            $this->link = $link;
            $this->integrity = $integrity;
        }

        /**
         * @return string
         */
        public function getName(): string {
            return $this->name;
        }

        /**
         * @param string $name
         */
        public function setName(string $name) {
            $this->name = $name;
        }

        /**
         * @return string
         */
        public function getLink(): string {
            return $this->link;
        }

        /**
         * @param string $link
         */
        public function setLink(string $link) {
            $this->link = $link;
        }

        /**
         * @return string
         */
        public function getIntegrity(): string {
            return $this->integrity;
        }

        /**
         * @param string $integrity
         */
        public function setIntegrity(string $integrity) {
            $this->integrity = $integrity;
        }
    }
