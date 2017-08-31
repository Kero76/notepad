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
     * @version 1.0
     */
    class Ticket {

        /**
         * @var int
         * @since 0.1
         */
        private $id;

        /**
         * @var string
         * @since 0.1
         */
        private $title;

        /**
         * @var string
         * @since 0.1
         */
        private $content;

        /**
         * @var \Notepad\Entity\Label
         * @since 0.1
         */
        private $label;

        /**
         * Ticket constructor.
         *
         * @since 0.1
         * @version 1.0
         */
        public function __construct() {
            $this->id = -1;
            $this->title = '';
            $this->content = '';
            $this->label = new Label();
        }

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
         * @since 0.1
         * @version 1.0
         */
        public function setTitle(string $title) {
            $this->title = $title;
        }

        /**
         * @return string
         * @since 0.1
         * @version 1.0
         */
        public function getContent(): string {
            return $this->content;
        }

        /**
         * @param string $content
         * @since 0.1
         * @version 1.0
         */
        public function setContent(string $content) {
            $this->content = $content;
        }

        /**
         * @return \Notepad\Entity\Label
         * @since 0.1
         * @version 1.0
         */
        public function getLabel(): Label {
            return $this->label;
        }

        /**
         * @param \Notepad\Entity\Label $label
         * @since 0.1
         * @version 1.0
         */
        public function setLabel(Label $label) {
            $this->label = $label;
        }
    }
