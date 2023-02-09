<h2>Description</h2>

A school management system with registered user and admin roles, in addition to unregistered user. Functionality for viewing and searching schools as well as registering pupils and making requests for them to join specific schools on the user side and adding, removing and updating schools, as well as confirming requests, on the admin side.

Pupil's date of birth automatically extracted, appropriately formatted and stored on the database from the pupil's personal ID code.

<b>UPDATE</b>: Added "User account" section with page for the pupils added by the user, functionality for updating pupil's data, requests page with a list of user's requests, account settings page (ability to change password and other info to be added). Added notifications functionality (user receives a notification when admin confirms a request from a specific pupil to join a school). A lot of UI appearance updates, including version for mobile. App deployed on Heroku, images uploaded by admin stored on AWS S3.

React.js used for frontend and Laravel for backend. Used token-based authentication with sanctum, in addition to protected routes on the frontend.

This is the backend repository. You can access the frontend repository <a href = "https://github.com/mykolasbar/ugdymo_istaigos_fe/">here</a>.

<h2>Functionality</h2>

<ul>
    <li>User roles:<li>
        <ul>
            <li>Unregistered user</li>
            <li>Registered user</li>
            <li>Admin</li>
        </ul>
    <li>Unregistered user:</li>
        <ul>
            <li>View schools</li>
            <li>Search schools (by their name)</li>
        </ul>
    <li>Regular user:</li>
        <ul>
            <li>View schools</li>
            <li>Search schools (by their name)</li>
            <li>Add one or more pupils</li>
            <li>User section with lists of pupils added and requests made</li>
            <li>Edit pupil info or delete pupil</li>
            <li>Send a request for a pupil to be registered to a particular school</li>
            <li>Notifications functionality</li>
        </ul>
    <li>Admin</li>
        <ul>
            <li>Add, update, delete schools</li>
            <li>Add pupils</li>
            <li>See list of incoming requests</li>
            <li>Confirm pupil requests</li>
        </ul>
</ul>

<h2>Launch instructions</h2>

<b>UPDATE</b>: App is currently accessible at: <a href="https://ugdymoistaigosfe.herokuapp.com/" target="_blank">https://ugdymoistaigosfe.herokuapp.com/</a>

Previous launch instructions (deprecated)

<ul>
    <li>Clone or download the github repository and put it in your xampp htdocs folder</li>
    <li>Import the database (Dump20221104.sql file in the downloaded repository) with MySQL Workbench or similar software</li>
    <li>Launch the development server on the default port http://127.0.0.1:8000/ (php artisan serve on your cli if you have laravel installed)</li>
</ul>

Made by Mykolas Baranauskas. <a href = "https://www.linkedin.com/in/mykolas-baranauskas-b3809b110/" target = "_blank">Linkedin</a>.
