# MYCOliveTestTrivia

## Welcome!

**Dear Applicant,**

We warmly welcome you on behalf of the MYCOlive development team.

This is the welcome page of your `HomeWork`, this is a Laravel + MYSQL project, which have been dockerized inside a container together.

> 💡 If you are not familiar with Docker, might worth check this [few minutes intro](https://www.youtube.com/watch?v=Gjnup-PuquQ&ab_channel=Fireship)

<br />
<br />

# Prerequisites

You will need to have Docker and Git to be installed on your computer

# Project Overview

![project overview](/assets/project-overview.png)

# Frontend Components and Workflow

You need to comply with the following Frontend UI workflow:

![project overview](/assets/front-end.png)

The workflow:

-   Register page
-   Login Page
-   Trivia question page
-   Store user's score on database
-   Final page depend's on user's score
-   If user able to get 100% questions correct, go to `success` page, else go to `fail` page.

# Your Task

We would like you to demonstrate your development skills and shine while creating a `Multiple choice Trivia Game` application.

You can use the following trivia questions as your question seed: https://opentdb.com/api.php?amount=10&category=9&difficulty=easy&type=multiple&encode=url3986

> 💡 You can also generate new topics using the Trivia API: https://opentdb.com/api_config.php.
> Please select your type to be `Multiple Choice`

## Fork the repo

Please fork this repo to your private GitHub user, so that you can commit to your own repo directly.

You can make your forked repo public. Anyway you'll benefit from having a new pet-project under your own github profile.

We expect you to `create a new branch`, work on that `branch` and send a `pull request`, merging back your forked repository to our original repository after completing your tasks defined below.

## Let's get started

After forking / cloning your repo, `cd` into folder directory & run `docker compose up -d`.

Congratulation, your app is now running on `localhost:2222`. We also just finish set up our own mysql database that is running on `127.0.0.1:1111`.

In the database, we already create a `users` table.

If you go to `localhost:2222`. We put a middleware to protect the route from an unauthenticated users. Hence you will be redirected to `localhost:2222/login`

## Do the chore 🧹 🧹

### Handle users registration

Go to `localhost:2222/register`, the signup page already set up for you. The view page can be find in `resources/view/register.blade.php`.

The controller for this can be found in `app/Http/Controllers/AuthController@register`.

What you need to do:

1. Send the user input to the backend, you can create a new path or controller in `web.php` as long as the controller able to verify and validate the input.
2. Validate the input. The input should be validate with the following contraint:

    - username is **required, unique, maximum length of 30 and minimum length of 6**
    - password is **required, maximum length of 30 and minimum length of 6**
    - password-confirmation is **required, and must be the same as password**

3. You should **show appropriate error message if any of the contraints got violated**.
4. Else, save the user credentials in the database. The schema of users table can be found in `database/migrations/2014_10_12_000000_create_users_table.php`.
5. Worth noting that the **user's password should be stored as a hashed**.
6. After that, the user need to be redirected to `/login`.

### Handle users login

Go to `localhost:2222/login`, the login page already set up for you. The view page can be find in `resources/view/login.blade.php`.

The controller for this can be found in `app/Http/Controllers/AuthController@login`.

What you need to do:

1. Send the user input to the backend, you can create a new path or controller in `web.php` as long as the controller able to verify and validate the input.
2. Validate the input. The input should be validate with the following contraint:

    - username is **required, maximum length of 30 and minimum length of 6**
    - password is **required, maximum length of 30 and minimum length of 6**

3. You should **show appropriate error message if any of the contraints got violated**.
4. If no users found with the given credentials, throw an error.
5. Else, login the users and redirect the user to `/`.

> For more information about how to authenticate a user, refer [here](https://laravel.com/docs/7.x/authentication#authenticating-users)

> Optional features if you still have more time:
>
> -   Create a middleware that prevent authenticated user from accessing `/login` and `/register`. Redirect them to `/` if they try to access it.
> -   Create a logout functionality

### Database

You don't need to worry about how to connect your apps with the database , everything already been handle with docker. We also just created and migrated a users table.

What you need to do:

1. Create a new table to store user's score and create an appropriate relationship with `users` table

> Tips 💡:
>
> -   To create a new migration, run `php artisan make:migration <YOUR TABLE NAME>`
> -   After finish setup your table, make a migration by running `php artisan migrate`.
> -   Refer [here for a complete documentation](https://laravel.com/docs/10.x/migrations#generating-migrations)

### Views

The views for `login`, `register`, `success`, and `fail` already added to `resources/views`. But it's not well wired together to satisfies the mentioned workflow. Feel free to tweak, tinker and use them as you wish.

We also created an empty view page for you in `resources/views/index.blade.php`.

What you need to do:

1. Using the empty view we created. Build a UI which shows the user with questions and multiple answers which was obtained from the third party API.
2. Minimal requirement for the UI are as follow:

![Question UI](/assets/question-ui.png)

3. You are free to style the page as you wish as long as the UI have the mentioned items.
4. For both `success` and `fail` views, you need to do some modifications to preview user's details, the instruction for this is further explained on both respective files.

> Optional features if you still have more time:
>
> -   Timeout handling on receiving the answer for the question

### Controller

So far we just created a single controller called `AuthController`. For best coding practice, we want to separate and assign different logics to a different controller.

What you need to do:

1. Create new controller which make an API call to https://opentdb.com/api.php?amount=10&category=9&difficulty=easy&type=multiple&encode=url3986
2. Link `/` route to this controller
3. Serve users with views from `resources/views/index.blade.php` together with the trivia questions from the API.

> Tips 💡:
>
> -   To create a new controller, run `php artisan make:controller <YOUR CONTROLLER NAME>`
> -   Refer [here for a complete documentation](https://laravel.com/docs/10.x/controllers#basic-controllers)

> Optional features if you still have more time:
>
> -   Handle incoming parameters (similar to https://opentdb.com/api_config.php API, ie. number of question, difficulty)

### User's Score

What you need to do:

1.  You need to handle storage of user's score inside a new table which was mentioned earlier.

## FAQ

-   **Q**: Where to run `php artisan` command?
    <br />
    **A**: Since all of our code lives inside docker container, you should run the command inside the `technical-interview-project` container.
-   **Q**: Can I create a new component? create my own styling or use third party library?
    <br />
    **A**: You are free to do so as long as the minimum requirement for the workflow are met.
-   **Q**: How many route should I create for this project?
    <br />
    **A**: Yes, you can create as many as you want as long as the minimum requirement for the workflow are met.

## This is what you are not task to do:

-   Running unit tests
-   Responsive design, the styling is not so much of a concern for this particular task but rather, the way you implement your solution to create the mentioned workflow is what matter the most.
-   Generate a new database
-   Tinkering around dockerfile and docker-compose

### References

-   https://laravel.com/docs/10.x
-   https://docs.docker.com/get-started/
-   https://www.youtube.com/watch?v=Gjnup-PuquQ&ab_channel=Fireship
