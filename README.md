# Ask the Company!

A simple questions and answers application intended for internal company use. It allows employees to (anonymously, if they wish) ask
questions that can be answered by an assigned set of managers. Email alerts are sent when new questions or asked or answered, and all
activity on answers is logged in an activity log. Questions and Answers can be categorized, archived, and searched. 
Currently only support AD authentication for admin access.

Build using CodeIgniter, with a little help from Twitter Bootstrap, Parsley.js, Font Awesome, and Animate.css.

Brought to you with love by your friends at [SolarVPS](http://www.solarvps.com)
 
## Setup

1. Clone the repo, and point your web server at the /application folder
2. Set your database and credentials in /application/config/database.php
3. Set your AD credentials in /application/config/adlap.php. 
4. Set your 'smtp_host', 'smtp_port', 'alertContacts' and 'admins' in /application/config/config.php
4a. (Alert contacts are emailed when a question is asked; admins are allowed to login with their AD credentials to answer questions.)
5. Create the required database tables using the included questions.sql file
6. Point your browser at /admin for managers to answer questions, and / for employees to ask, search for and view questions.

## License

(The MIT License)

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
