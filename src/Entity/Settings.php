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

    use Symfony\Component\Yaml\Yaml;

    /**
     * Class Settings
     *
     * @author Nicolas GILLE
     * @package Notepad\Entity
     * @since 0.5
     * @version 1.1
     */
    class Settings {

        /**
         * @var \Notepad\Entity\Settings
         * @since 1.1
         */
        private static $instance = null;

        /**
         * @var string
         * @since 1.0
         */
        private static $SETTING_PATH_FILE = '../app/settings.yml';

        /**
         * @var bool
         * @since 1.0
         */
        private $websiteDebug;

        /**
         * @var int
         * @since 1.0
         */
        private $websiteTruncate;

        /**
         * @var string
         * @since 1.0
         */
        private $websiteTitleSeparator;

        /**
         * @var string
         * @since 1.1
         */
        private $websiteReleaseYear;

        /**
         * @var string
         * @since 1.1
         */
        private $themeName;

        /**
         * @var string
         * @since 1.1
         */
        private $themeLink;

        /**
         * @var string
         * @since 1.1
         */
        private $themeIntegrity;

        /**
         * @var int
         * @since 1.1
         */
        private $gravatarSize;

        /**
         * @var string
         * @since 1.1
         */
        private $gravatarRating;

        /**
         * @var string
         * @since
         */
        private $gravatarDefaultImage;

        /**
         * @var bool
         * @since 1.1
         */
        private $gravatarForceDefaultImage;

        /**
         * @var bool
         * @since 1.1
         */
        private $gravatarSecureRequest;

        /**
         * Settings constructor.
         *
         * @since 1.0
         * @version 1.0
         */
        public function __construct() {
            $settings = Yaml::parse(file_get_contents(Settings::$SETTING_PATH_FILE));
            $this->websiteDebug = $settings['website']['debug'];
            $this->websiteTruncate = $settings['website']['truncate'];
            $this->websiteTitleSeparator = $settings['website']['title_separator'];
            $this->websiteReleaseYear = $settings['website']['release_year'];

            $this->themeName = $settings['theme']['name'];
            $this->themeLink = $settings['theme']['link'];
            $this->themeIntegrity = $settings['theme']['integrity'];

            $this->gravatarSize = $settings['gravatar']['size'];
            $this->gravatarRating = $settings['gravatar']['rating'];
            $this->gravatarDefaultImage = $settings['gravatar']['default_image'];
            $this->gravatarForceDefaultImage = $settings['gravatar']['force_default_image'];
            $this->gravatarSecureRequest = $settings['gravatar']['secure_request'];
        }

        /**
         * Get the unique instance of Settings and instantiate it if necessary.
         *
         * @see https://www.tutorialspoint.com/design_pattern/singleton_pattern.htm
         * @return \Notepad\Entity\Settings
         *  Return the unique instance of Setting.
         * @since 1.1
         * @version 1.0
         */
        public static function getInstance() {
            if (Settings::$instance === null) {
                Settings::$instance = new Settings();
            }

            return Settings::$instance;
        }

        /**
         * @return bool
         * @since 1.0
         * @version 1.1
         */
        public function isWebsiteDebug(): bool {
            return $this->websiteDebug;
        }

        /**
         * @param bool $websiteDebug
         *
         * @since 1.0
         * @version 1.1
         */
        public function setWebsiteDebug(bool $websiteDebug) {
            $this->websiteDebug = $websiteDebug;
        }

        /**
         * @return int
         * @since 1.0
         * @version 1.1
         */
        public function getWebsiteTruncate(): int {
            return $this->websiteTruncate;
        }

        /**
         * @param int $websiteTruncate
         *
         * @since 1.0
         * @version 1.1
         */
        public function setWebsiteTruncate(int $websiteTruncate) {
            $this->websiteTruncate = $websiteTruncate;
        }

        /**
         * @return string
         * @since 1.0
         * @version 1.1
         */
        public function getWebsiteTitleSeparator(): string {
            return $this->websiteTitleSeparator;
        }

        /**
         * @param string $websiteTitleSeparator
         *
         * @since 1.0
         * @version 1.1
         */
        public function setWebsiteTitleSeparator(string $websiteTitleSeparator) {
            $this->websiteTitleSeparator = $websiteTitleSeparator;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getWebsiteReleaseYear(): string {
            return $this->websiteReleaseYear;
        }

        /**
         * @param string $websiteReleaseYear
         *
         * @since 1.1
         * @version 1.0
         */
        public function setWebsiteReleaseYear(string $websiteReleaseYear) {
            $this->websiteReleaseYear = $websiteReleaseYear;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getThemeName(): string {
            return $this->themeName;
        }

        /**
         * @param string $themeName
         *
         * @since 1.1
         * @version 1.0
         */
        public function setThemeName(string $themeName) {
            $this->themeName = $themeName;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getThemeLink(): string {
            return $this->themeLink;
        }

        /**
         * @param string $themeLink
         *
         * @since 1.1
         * @version 1.0
         */
        public function setThemeLink(string $themeLink) {
            $this->themeLink = $themeLink;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getThemeIntegrity(): string {
            return $this->themeIntegrity;
        }

        /**
         * @param string $themeIntegrity
         *
         * @since 1.1
         * @version 1.0
         */
        public function setThemeIntegrity(string $themeIntegrity) {
            $this->themeIntegrity = $themeIntegrity;
        }

        /**
         * @return int
         * @since 1.1
         * @version 1.0
         */
        public function getGravatarSize(): int {
            return $this->gravatarSize;
        }

        /**
         * @param int $gravatarSize
         *
         * @since 1.1
         * @version 1.0
         */
        public function setGravatarSize(int $gravatarSize) {
            $this->gravatarSize = $gravatarSize;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getGravatarRating(): string {
            return $this->gravatarRating;
        }

        /**
         * @param string $gravatarRating
         *
         * @since 1.1
         * @version 1.0
         */
        public function setGravatarRating(string $gravatarRating) {
            $this->gravatarRating = $gravatarRating;
        }

        /**
         * @return string
         * @since 1.1
         * @version 1.0
         */
        public function getGravatarDefaultImage(): string {
            return $this->gravatarDefaultImage;
        }

        /**
         * @param string $gravatarDefaultImage
         *
         * @since 1.1
         * @version 1.0
         */
        public function setGravatarDefaultImage(string $gravatarDefaultImage) {
            $this->gravatarDefaultImage = $gravatarDefaultImage;
        }

        /**
         * @return bool
         * @since 1.1
         * @version 1.0
         */
        public function isGravatarForceDefaultImage(): bool {
            return $this->gravatarForceDefaultImage;
        }

        /**
         * @param bool $gravatarForceDefaultImage
         *
         * @since 1.1
         * @version 1.0
         */
        public function setGravatarForceDefaultImage(bool $gravatarForceDefaultImage) {
            $this->gravatarForceDefaultImage = $gravatarForceDefaultImage;
        }

        /**
         * @return bool
         * @since 1.1
         * @version 1.0
         */
        public function isGravatarSecureRequest(): bool {
            return $this->gravatarSecureRequest;
        }

        /**
         * @param bool $gravatarSecureRequest
         *
         * @since 1.1
         * @version 1.0
         */
        public function setGravatarSecureRequest(bool $gravatarSecureRequest) {
            $this->gravatarSecureRequest = $gravatarSecureRequest;
        }
    }
