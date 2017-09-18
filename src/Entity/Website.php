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

    use DateTime;

    /**
     * Class Website
     *
     * @author Nicolas GILLE
     * @package Notepad\Entity
     * @since 0.6
     * @version 1.0
     */
    class Website {

        /**
         * @var string
         * @since 1.0
         */
        private $separator;

        /**
         * @var bool
         * @since 1.0
         */
        private $debug;

        /**
         * @var int
         * @since 1.0
         */
        private $truncate;

        /**
         * @var string
         * @since 1.0
         */
        private $releaseYear;

        /**
         * @var string
         * @since 1.0
         */
        private $currentYear;

        /**
         * Website constructor.
         *
         * @param string $separator
         * @param bool $debug
         * @param int $truncate
         * @param string $releaseYear
         *
         * @since 1.0
         * @version 1.0
         */
        public function __construct(string $separator, bool $debug, int $truncate, string $releaseYear) {
            $this->separator = $separator;
            $this->debug = $debug;
            $this->truncate = $truncate;
            $this->releaseYear = $releaseYear;

            // Get current date.
            $currentYear = new DateTime();
            $this->currentYear = $currentYear->format('Y');
        }

        /**
         * @return string
         * @since 1.0
         * @version 1.0
         */
        public function getSeparator(): string {
            return $this->separator;
        }

        /**
         * @param string $separator
         *
         * @since 1.0
         * @version 1.0
         */
        public function setSeparator(string $separator) {
            $this->separator = $separator;
        }

        /**
         * @return bool
         * @since 1.0
         * @version 1.0
         */
        public function isDebug(): bool {
            return $this->debug;
        }

        /**
         * @param bool $debug
         *
         * @since 1.0
         * @version 1.0
         */
        public function setDebug(bool $debug) {
            $this->debug = $debug;
        }

        /**
         * @return int
         * @since 1.0
         * @version 1.0
         */
        public function getTruncate(): int {
            return $this->truncate;
        }

        /**
         * @param int $truncate
         *
         * @since 1.0
         * @version 1.0
         */
        public function setTruncate(int $truncate) {
            $this->truncate = $truncate;
        }

        /**
         * @return string
         * @since 1.0
         * @version 1.0
         */
        public function getReleaseYear(): string {
            return $this->releaseYear;
        }

        /**
         * @param string $releaseYear
         *
         * @since 1.0
         * @version 1.0
         */
        public function setReleaseYear(string $releaseYear) {
            $this->releaseYear = $releaseYear;
        }

        /**
         * @return string
         * @since 1.0
         * @version 1.0
         */
        public function getCurrentYear(): string {
            return $this->currentYear;
        }
    }
