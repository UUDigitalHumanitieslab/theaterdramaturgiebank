=======================
TheaterDramaturgie.Bank
=======================
Technical and user documentation


Introduction
============
In this document we'll describe how to add new and edit existing content for the TheaterDramaturgieBank_ WordPress_ website. We'll focus mainly on adding and editing speakers and videos. 
WordPress is a commonly used content management system, so if there's something you can't seem to find in this document, you might be able to find a solution by googling. Also, each page in the administrative section of WordPress has a "Help" button on the top right of the page.

.. _TheaterDramaturgieBank: http://theaterdramaturgiebank.sites.uu.nl/
.. _WordPress: https://wordpress.org/

Authentication
==============

Logging in
----------
You can log in to the administrative section of the website via `this link`_. Use your Solis-ID and password to log in. After logging in, you'll end up in the WordPress Dashboard.

.. _`this link`: https://theaterdramaturgiebank.sites.uu.nl/wp-admin/

Adding users
------------
You can add users by navigating to *Users -> Add user*. You can use Solis-ID's in the username field. For the role, you can choose what suits you, see here for an overview of capabilities per role.

.. _here: https://codex.wordpress.org/Roles_and_Capabilities#Summary_of_Roles

Searching
=========
The database can be searched 

Note that the database will be automatically re-indexed after updating a post. If you would want to a manual 

Editing posts
=============

Adding a person
---------------
You can add persons via the *Posts* section of the dashboard. Create a new post by clicking the *Add New* button. In the right part of the window, select *Person* as category. This will add a few extra fields to your post:

- First name
- Tussenvoegsel
- Last name (used for lookup in the alphabetical index)
- Link (to the speaker's website) 

Make sure to fill out all required fields (marked by a red asterisk) and click the blue *Publish* button to add the speaker to the website. You can also save a draft by clicking the grey *Save draft* button. 

Editing a person
----------------
In the *Posts* section, you can also edit persons by clicking the items in the list. You can use the filters above the post list to only select posts that have the category *Person*. You can also search the archive with the search filter on the right.

Adding videos from YouTube, Vimeo, etc.
---------------------------------------
If you would like to add videos to a post, you can use the *embed shortcode* for that. Copy the url from the address bar and and wrap this into embed tags. You can set the width and height as well, e.g:

``[embed width="123" height="456"]http://www.youtube.com/watch?v=dQw4w9WgXcQ[/embed]``

Editing other content
=====================
About section on home page
--------------------------
You can edit the about section on the home page by navigating to *Appearance -> Widgets*. In the box named “Home Widget Area 1” there's a widget called “About this website”. If you click on the widget, you'll find a button with which you can edit the content of this widget.

About page in menu 
------------------
You can edit the about page from the menu by navigating to *Pages* and then clicking the page titled *About*.
 
Contact page in menu 
--------------------
You can edit the about page from the menu by navigating to *Pages* and then clicking the page titled *Contact*.

Martijn van der Klis, `Digital Humanities Lab`_, 12 January 2017.

.. _`Digital Humanities Lab`: http://dig.hum.uu.nl/
