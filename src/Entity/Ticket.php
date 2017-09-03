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
     * Class Ticket.
     *
     * This class represent a ticket present on Notepad.
     * In fact, each note is represent as a ticket with a title and the content of the ticket.
     *
     * @author Nicolas GILLE
     * @package Notepad\Entity
     * @since 0.1
     * @version 1.2
     */
    class Ticket {

        /**
         * @var int
         * @since 1.0
         */
        private $id;

        /**
         * @var string
         * @since 1.0
         */
        private $title;

        /**
         * @var string
         * @since 1.0
         */
        private $content;

        /**
         * @var \Notepad\Entity\Label
         * @since 1.0
         */
        private $label;

        /**
         * @var string
         * @since 1.1
         */
        private $releaseDate;

        /**
         * @var string
         * @since 1.1
         */
        private $lastModified;

        /**
         * @var bool
         * @since 1.2
         */
        private $isArchive;

        /**
         * Ticket constructor.
         *
         * @since 1.0
         * @version 1.1
         */
        public function __construct() {
            $this->id = -1;
            $this->title = '';
            $this->content = '';
            $this->label = new Label();
            $this->releaseDate = '';
            $this->lastModified = '';
            $this->isArchive = false;
        }

        /**
         * @return int
         * @since 1.0
         * @version 1.0
         */
        public function getId(): int {
            return $this->id;
        }

        /**
         * @param int $id
         * @since 1.0
         * @version 1.0
         */
        public function setId(int $id) {
            $this->id = $id;
        }

        /**
         * @return string
         * @since 1.0
         * @version 1.0
         */
        public function getTitle(): string {
            return $this->title;
        }

        /**
         * @param string $title
         * @since 1.0
         * @version 1.0
         */
        public function setTitle(string $title) {
            $this->title = $title;
        }

        /**
         * @return string
         * @since 1.0
         * @version 1.0
         */
        public function getContent(): string {
            return $this->content;
        }

        /**
         * @param string $content
         * @since 1.0
         * @version 1.0
         */
        public function setContent(string $content) {
            $this->content = $content;
        }

        /**
         * @return \Notepad\Entity\Label
         * @since 1.0
         * @version 1.0
         */
        public function getLabel(): Label {
            return $this->label;
        }

        /**
         * @param \Notepad\Entity\Label $label
         * @since 1.0
         * @version 1.0
         */
        public function setLabel(Label $label) {
            $this->label = $label;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getReleaseDate(): string {
            return $this->releaseDate;
        }

        /**
         * @param \DateTime $releaseDate
         * @since 1.1
         * @version 1.0
         */
        public function setReleaseDate(\DateTime $releaseDate) {
            $this->releaseDate = $releaseDate->format('Y-m-d H:i:s');
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getLastModified(): string {
            return $this->lastModified;
        }

        /**
         * @param \DateTime $lastModified
         * @since 1.1
         * @version 1.0
         */
        public function setLastModified(\DateTime $lastModified) {
            $this->lastModified = $lastModified->format('Y-m-d H:i:s');
        }

        /**
         * @return bool
         * @since 1.2
         * @version 1.0
         */
        public function isArchive(): bool {
            return $this->isArchive;
        }

        /**
         * @param bool $isArchive
         * @since 1.2
         * @version 1.0
         */
        public function setIsArchive(bool $isArchive) {
            $this->isArchive = $isArchive;
        }
    }
