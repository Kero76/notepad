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

    use Symfony\Component\Security\Core\User\UserInterface;

    /**
     * Class User.
     *
     * @author Nicolas GILLE
     * @package Notepad\Entity
     * @since 0.1
     * @version 1.1
     */
    class User implements UserInterface {

        /**
         * Identifier of the user.
         *
         * @var integer
         * @since 1.0
         */
        private $id = -1;

        /**
         * Username of the user.
         *
         * @var string
         * @since 1.0
         */
        private $username = '';

        /**
         * Email of the user.
         *
         * @var string
         * @since 1.0
         */
        private $email = '';

        /**
         * Password of the user.
         *
         * @var string
         * @since 1.0
         */
        private $password = '';

        /**
         * Salt to improve security of the app.
         *
         * @var string
         * @since 1.0
         */
        private $salt = '';

        /**
         * Role of the user :
         * <ul>
         *  <li>ROLE_USER</li>
         *  <li>ROLE_ADMIN</li>
         * </ul>
         *
         * @var string
         * @since 1.0
         */
        private $role = '';

        /**
         * @var string
         * @since 1.1
         */
        private $biography = '';

        /**
         * Link for personal website.
         *
         * @var string
         * @since 1.1
         */
        private $website = '';

        /**
         * Twitter username.
         *
         * @var string
         * @since 1.1
         */
        private $twitter = '';

        /**
         * GoodReads username.
         *
         * @var string
         * @since 1.1
         */
        private $goodreads = '';

        /**
         * Return the id of the user.
         *
         * @return int
         *  Identifier of the user.
         * @since 1.0
         * @version 1.0
         */
        public function getId(): int {
            return $this->id;
        }

        /**
         * Set the id of the user.
         *
         * @param int $id
         *  Identifier of the user.
         *
         * @since 1.0
         * @version 1.0
         */
        public function setId(int $id) {
            $this->id = $id;
        }

        /**
         * Get email of the user.
         *
         * @return string
         *  The email of the user.
         * @since 1.0
         * @version 1.0
         */
        public function getEmail(): string {
            return $this->email;
        }

        /**
         * Set the mail of the user.
         *
         * @param string $email
         *  New email of the user.
         *
         * @since 1.0
         * @version 1.0
         */
        public function setEmail(string $email) {
            $this->email = $email;
        }

        /**
         * @inheritdoc
         */
        public function eraseCredentials() {
            // Nothing implementation for the moment.
        }

        /**
         * @inheritdoc
         */
        public function getPassword() {
            return $this->password;
        }

        /**
         * Set password of user.
         *
         * @param string $password
         *  New password encoded.
         *
         * @since 1.0
         * @version 1.0
         */
        public function setPassword(string $password) {
            $this->password = $password;
        }

        /**
         * @inheritdoc
         */
        public function getRoles() {
            return array($this->getRole());
        }

        /**
         * Get the role of the user.
         *
         * @return string
         *  Role of the user.
         * @since 1.0
         * @version 1.0
         */
        public function getRole(): string {
            return $this->role;
        }

        /**
         * Set the role of the user.
         *
         * @param string $role
         *  New role of the user.
         *
         * @since 1.0
         * @version 1.0
         */
        public function setRole(string $role) {
            $this->role = $role;
        }

        /**
         * @inheritdoc
         */
        public function getSalt() {
            return $this->salt;
        }

        /**
         * Set salt to encode password properly.
         *
         * @param string $salt
         *  New salt.
         *
         * @since 1.0
         * @version 1.0
         */
        public function setSalt(string $salt) {
            $this->salt = $salt;
        }

        /**
         * @inheritdoc
         */
        public function getUsername() {
            return $this->username;
        }

        /**
         * Set the username of the user.
         *
         * @param string $username
         *  New username.
         *
         * @since 1.0
         * @version 1.0
         */
        public function setUsername(string $username) {
            $this->username = $username;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getBiography(): string {
            return $this->biography;
        }

        /**
         * @param string $biography
         *
         * @since 1.1
         * @version 1.0
         */
        public function setBiography(string $biography) {
            $this->biography = $biography;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getWebsite(): string {
            return $this->website;
        }

        /**
         * @param string $website
         *
         * @since 1.1
         * @version 1.0
         */
        public function setWebsite(string $website) {
            $this->website = $website;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getTwitter(): string {
            return $this->twitter;
        }

        /**
         * @param string $twitter
         *
         * @since 1.1
         * @version 1.0
         */
        public function setTwitter(string $twitter) {
            $this->twitter = $twitter;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getGoodreads() : string {
            return $this->goodreads;
        }

        /**
         * @param string $goodreads
         *
         * @since 1.1
         * @version 1.0
         */
        public function setGoodreads(string $goodreads) {
            $this->goodreads = $goodreads;
        }

    }
