api-books v1.0
===========================


Introduction
------------

"api-books" is a simple native php made api. It provides access to a database, which stores metadata of books (like title, author, publishing company).


Overview
--------

"api-books" provides read and write access. "book" is the central resource, which is actually a collection of metadata to a physical book. A book can be created, updated and deleted. The api returns status code 200 and a JSON body. The JSON body contains information about a positive or negative request result.


Requirements
------------

* MySQL database server
* php 7.0 or newer


Program Code Explained
----------------------

The project "api-books" consists of the 3 folders "config", "models", „api“.

Folder "config" provides the connection to the MySQL database server and the login credentials are stored there.

Folder "models" contains the ORM of the database tables "books" and „genres“. Each table is represented by a corresponding object. 

Folder "api" has the subfolders "books" and "genres". These folders have one php script for each api function. E.g. the api function to read one book from the database is represented by the php script "/books/read_single.php". These php scripts create JSON strings and print them as a response to server requests.

The passing of variables between database and api functions is realized by the attributes of the ORM objects. E.g. if a book is selected from database the attributes of the book object are filled with the column values of the specific table. These attributes are read from the php script that implements the specific api function to read information from the corresponding table. The other way round user input (e.g. the content of a http POST request body) is saved to the attributes of an ORM object. By the attributes of the ORM object the database request will be created.



