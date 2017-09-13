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

    /**
     * Class WebBrowser
     *
     * @author Nicolas GILLE
     * @package Notepad\Utils
     * @since 0.5
     * @version 1.0
     */
    namespace Notepad\Utils;

    use Symfony\Component\Yaml\Yaml;

    class Settings {

        /**
         * @var string
         * @since 1.0
         */
        private static $SETTING_PATH_FILE = '../app/settings.yml';

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
        private $titleSeparator;

        /**
         * Settings constructor.
         *
         * @since 1.0
         * @version 1.0
         */
        public function __construct() {
            $settings = Yaml::parse(file_get_contents(Settings::$SETTING_PATH_FILE));
            $this->debug = $settings['website']['debug'];
            $this->truncate = $settings['website']['truncate'];
            $this->titleSeparator = $settings['website']['title_separator'];
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
         * @param int $truncateSize
         *
         * @since 1.0
         * @version 1.0
         */
        public function setTruncate(int $truncateSize) {
            $this->truncate = $truncateSize;
        }

        /**
         * @return string
         * @since 1.0
         * @version 1.0
         */
        public function getTitleSeparator(): string {
            return $this->titleSeparator;
        }

        /**
         * @param string $titleSeparator
         *
         * @since 1.0
         * @version 1.0
         */
        public function setTitleSeparator(string $titleSeparator) {
            $this->titleSeparator = $titleSeparator;
        }
    }
