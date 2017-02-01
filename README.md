# TheaterDramaturgie.Bank

This repository contains the code of the TheaterDramaturgie.Bank, located at http://theaterdramaturgiebank.sites.uu.nl/. 
It's a [WordPress child theme](https://codex.wordpress.org/Child_Themes) of the [default Utrecht University theme](https://github.com/ictenmediaUU/UU2014).

Below is a breakdown of the function of each file in this repository:

* docs: Contains the documentation.
* languages: Contains language files, but as the database is currently monolingual, these files are not important.
* parts: Contains small snippets of code that are included in other pages.
  * `brandbar.php`: Customization of the top brand bar. Added the site title to the bar and removed search functionality.
  * `colofon.php`: Customization of the bottom bar. Removed most items, only displays the Digital Humanities lab logo.
  * `record-loop.php`: Functionality for looping over a post with the 'Record' category. Referenced from `category-record.php`.
  * `record-random.php`: Functionality for looping over a post with the 'Record' category on the front page. References from `index.php`.
* libraries: Contains external libraries.
  * `Parsedown.php`: Markdown parser in PHP. Retrieved from https://github.com/erusev/parsedown.
* `category-collection.php`: Template for displaying a list of posts with the 'Collection' category.
* `category-record.php`: Template for displaying a list of posts with the 'Record' category.
* `functions.php`: Specific functions for this template.
* `header.php`: Custom header, removed the site title.
* `index.php`: Customized front page, displaying a search form and a random post with the 'Record' category.
* `page-authors.php`: Page for displaying all authors in an alphabetical listing.
* `page-keywords.php`: Page for displaying all tags in an alphabetical listing.
* `single-collection.php`: Template for displaying a single post with the 'Collection' category.
* `single-person.php`: Template for displaying a single post with the 'Person' category.
* `single-record.php`: Template for displaying a single post with the 'Record' category.
* `style.css`: Custom CSS. 
