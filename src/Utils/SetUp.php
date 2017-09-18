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

    namespace Notepad\Utils;

    use GravatarLib\Gravatar\Gravatar;
    use Notepad\Entity\Settings;
    use Notepad\Entity\Theme;
    use Notepad\Entity\Website;

    /**
     * Class SetUp.
     *
     * @author Kero76
     * @package Notepad\Utils
     * @since 0.6
     * @version 1.0
     */
    class SetUp {

        /**
         * Set up theme to display on app.
         *
         * @return \Notepad\Entity\Theme
         *  Return the theme used by the app.
         * @since 1.0
         * @version 1.0
         */
        public static function setUpTheme() {
            $settings = Settings::getInstance();
            return new Theme(
                $settings->getThemeName(),
                $settings->getThemeLink(),
                $settings->getThemeIntegrity()
            );
        }

        /**
         * Set up gravatar service with settings get from the setting file.
         *
         * @return \GravatarLib\Gravatar\Gravatar
         *  Return the Gravatar object set up with settings.
         * @since 1.0
         * @version 1.0
         */
        public static function setUpGravatar() {
            $settings = Settings::getInstance();
            return new Gravatar(
                $settings->getGravatarSize(),
                $settings->getGravatarDefaultImage(),
                $settings->isGravatarForceDefaultImage(),
                $settings->getGravatarRating(),
                $settings->isGravatarSecureRequest()
            );
        }

        /**
         * Set up the settings for the website.
         *
         * @return \Notepad\Entity\Website
         *  Return the object Website with all website settings.
         * @since 1.0
         * @version 1.0
         */
        public static function setUpWebsite() {
            $settings = Settings::getInstance();
            return new Website(
                $settings->getWebsiteTitleSeparator(),
                $settings->isWebsiteDebug(),
                $settings->getWebsiteTruncate(),
                $settings->getWebsiteReleaseYear()
            );
        }
    }
