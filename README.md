# TheaterDramaturgie.Bank

This repository contains the code of the TheaterDramaturgie.Bank, located at http://theaterdramaturgiebank.sites.uu.nl/. 
It's a [WordPress child theme](https://codex.wordpress.org/Child_Themes) of the [default Utrecht University theme](https://github.com/ictenmediaUU/UU2014).

Below is a breakdown of the function of each file.

* parts
** `brandbar.php`: Customization of the top brand bar. Added the site title to the bar and removed search functionality.
** `entry-loop.php`: Functionality for looping over a post with the 'Entry' category. Referenced from `category-entry.php`.
* `category-entry.php`: Template for displaying a list of posts with the 'Entry' category.
* `functions.php`: Specific functions for this template.
* `header.php`: Custom header, removed the site title.
* `index.php`: Customized front page, displaying a search form and a random post with the 'Entry' category.
* `single-entry.php`: Template for displaying a single post with the 'Entry' category.
* `style.css`: Custom CSS. 
