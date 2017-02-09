==========================================
TheaterDramaturgie.Bank user documentation
==========================================

Introduction
============
In this document we'll describe how to add new and edit existing content for the TheaterDramaturgieBank_ WordPress_ website. 
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
You can add users by navigating to *Users -> Add user*. You can use Solis-ID's in the username field. For the role, you can choose what suits you, see `here`_ for an overview of capabilities per role.

.. _here: https://codex.wordpress.org/Roles_and_Capabilities#Summary_of_Roles

Searching
=========
The database can be searched using the faceted search provided by FacetWP_. You can change some of the facet settings in the *Settings -> FacetWP* administration menu item (tab *Facets*). You can e.g. change the number of items shown for the facet 'Author' by clicking on it and changing the values for the *Count* and *Soft limit* fields. Full documentation can be found on `the FacetWP website`_.

Note that the database will be automatically re-indexed after updating a post. If you would want to a manual re-index, you can do that by clicking the (white) *Re-index* button in the *Settings -> FacetWP* administration menu item (tab *Facets*).

.. _FacetWP: https://facetwp.com/
.. _`the FacetWP website`: https://facetwp.com/documentation/

Importing posts
===============
You can import new posts (or update existing posts) by using the `WP All Import`_ plug-in. This plug-in allows for uploading .csv-files into WordPress. A .csv-file can be created from Microsoft Excel by using the *Save as...*-functionality.

The plug-in can be accessed from the administration menu by clicking on *All Import*. Click *Manage imports* from the menu to view existing imports, and click one the available import to upload a new version of the file which contains all records. The importer will try to match each row of the import to an existing post by using the **key** field from the .csv-file. If there's no post with this key, the importer will create a new post.

In the bibliography field, you can use `Markdown`_ to format content (e.g. bold/italic font). This will be converted to HTML during import (using the `Parsedown`_ parser).

.. _`WP All Import`: http://www.wpallimport.com/
.. _Markdown: https://en.wikipedia.org/wiki/Markdown
.. _Parsedown: https://github.com/erusev/parsedown

Editing posts
=============

Adding a record
---------------
Normally, records are created during import (see the previous section), but if necessary, you can add records via the *Posts* section of the dashboard. Create a new post by clicking the *Add New* button. In the right part of the window, select *record* as category. This will add a few extra fields to your post:

- Author(s)
- Collection
- Year
- Languages
- People
- Performance(s)
- Issue
- Original publication
- Publisher
- Bibliography
- Has full-text?

Make sure to fill out all required fields (marked by a red asterisk) and click the blue *Publish* button to add the record to the website. You can also save a draft by clicking the grey *Save draft* button. 

Adding a collection
-------------------
You can add collections via the *Posts* section of the dashboard. Create a new post by clicking the *Add New* button. In the right part of the window, select *Collection* as category. Make sure to use the **exact same slug** that is used for records to be able to show records linked to a collection.

Make sure to fill out all required fields (marked by a red asterisk) and click the blue *Publish* button to add the person to the website. You can also save a draft by clicking the grey *Save draft* button. 

Adding a person
---------------
You can add persons via the *Posts* section of the dashboard. Create a new post by clicking the *Add New* button. In the right part of the window, select *Person* as category. This will add a few extra fields to your post:

- First name
- Tussenvoegsel
- Last name (used for lookup in the alphabetical index)
- Link (to the speaker's website) 

Make sure to fill out all required fields (marked by a red asterisk) and click the blue *Publish* button to add the person to the website. You can also save a draft by clicking the grey *Save draft* button. 

Editing posts
-------------
In the *Posts* section, you can also edit persons by clicking the items in the list. You can use the filters above the post list to only select posts of a specific category. You can also search the archive with the search filter on the right.

Adding images
-------------
To add images to a post, you can use either the *Featured image* (bottom right when you edit a post) or add images inline using the *Add media* button. The former is only shown for collections, in the list of collections as well as on the detail page.

Adding videos from YouTube, Vimeo, etc.
---------------------------------------
If you would like to add videos to a post, you can use the *embed shortcode* for that. Copy the url from the address bar and and wrap this into embed tags. You can set the width and height as well, e.g:

``[embed width="123" height="456"]http://www.youtube.com/watch?v=dQw4w9WgXcQ[/embed]``

Editing other content
=====================

About page in menu 
------------------
You can edit the about page from the menu by navigating to *Pages* and then clicking the page titled *About*.
 
Contact page in menu 
--------------------
You can edit the contact page from the menu by navigating to *Pages* and then clicking the page titled *Contact*.

Martijn van der Klis, `Digital Humanities Lab`_, 18 January 2017.

.. _`Digital Humanities Lab`: http://dig.hum.uu.nl/
