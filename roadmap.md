```
Future Roadmap & Improvements
-----------------------------

Since the project is my first ever Web Development project,
I'm building it from complete scratch as I learn more about the subject.

Version 1.0 currently has a simple DB with two simple, non-relational tables.
In the 2.0 version I plan to make a relational DB with more focus on
client data and different bank accounts.

Before I finalize v1.0 though, I want to polish it as much as possible
regarding safety and UI/UX, while keeping the retro visual style of the project.

One of the features I feel the need to add/learn is Cross-Site Request Forgery (CSRF) protection.
It is used to prevent malicious url from being executed if clicked on from another window
(eg. a malicious e-mail). In order to prevent this, every form will need a hidden, random "token"
that is generated when the page loads. The server then has to check if the token in the form matches 
the token in the session. If not, it has to block the request.

```
