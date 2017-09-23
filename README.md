# Notepad
Notepad is an online notepad used to stored important information and get it from another computers.

# Prerequisites
- PHP 7.0 >=
- composer 1.0 >= 
- SQL Database System (MySQL by default).

# How to install & configure Notepad ?
## Installation
1. Download or clone source.
2. Post source on your personal server.
3. Execute `$ composer install` to download dependencies.
4. Configure _Notepad_ environment and _Notepad_ itself. 
5. Use your favorite web browser and use _Notepad_.

## Configuration
### Database access configuration
1. Create a Database with `notepad` name.
2. You can comment line 32 to 47 of the file `notepad/db/init.sql`, and load it on your database to create tables.
3. If you use a MySQL database, you just change the line `user` and `password` with your database username and password.
4. In other case, you can get more information on [DBAL Doctrine](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html) to change the driver and all others information.

### Settings.yml
This file locate on _notepad/app/settings.yml_ contains all settings of the app.
Website section contains all settings used to personalized the app.
- `title_separator` : Indicate the string use to separate Notepad to the page name on browser tab. 
- `debug` : Change the value for adding log to help debugging.
- `truncate` : The number of character to show on content before add _..._. 
- `release_year` : Change it with the release year.

Theme section contains all settings to add theme on app design.
- `name` : Name of the theme.
- `link` : Link of the theme.
- `integrity` : Integrity of the theme.
You can get all information for the theme on _notepad/app/themes.yml_ file.
If you cannot applied theme, you must leave fields empty.

Gravatar section contains settings relative to gravatar configuration.
- `size` : Size of the image between 0 and 2048 pixels.
- `rating` : Rating of image allowed on app.
- `default_image` : Change default image show on app.
- `force_default_image` : Force default image show on app.
- `secure_request` : Boolean to indicate if you call gravatar in HTTPS or HTTP.
_Nota.Bene_ : You can get more information directly on [Gravatar](https://fr.gravatar.com/site/implement/images/) for attribute value.


# Features includes 
- Create, edit and delete ticket.
- Create and auto-remove useless label for your ticket.
- Sign up on app to create and manage ticket.
- Change many settings from external file like number of character before truncate content on home page, debug mode, ...

# Changelog
- Notepad v0.6 - Released September 23, 2017
- Notepad v0.5 - Released September 07, 2017
- Notepad v0.4 - Released September 05, 2017
- Notepad v0.3 - Released September 04, 2017
- Notepad v0.2 - Released September 02, 2017
- Notepad v0.1 - Released September 01, 2017

# License
This project is under GPLv3 license.

# Contributors
- Nicolas GILLE : <nic.gille@gmail.com>
