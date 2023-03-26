# Laravel MailerLite Integration

This project is a Laravel application that integrates with the MailerLite API to manage subscribers. The application is built using Laravel ^8.75 and PHP ^7.4.

## Technical Information

The project uses the following libraries, which are included via CDN:

- jQuery
- Bootstrap
- Toastr
- DataTables
- Bootstrap-select
- Font Awesome

### MailerLite Integration

The MailerLite integration is done using a custom-made package under the `integrations` directory. Make sure to run `composer dump-autoload` to load the package.

### Database

An SQL file is available under the `database` directory, so there's no need to run migrations.

### Environment

Set the MailerLite `MAILERLITE_API_TOKEN` and `MAILERLITE_API_ENDPOINT` in the `.env` file, which can be created using `.env.example`.

## Features

### Connect MailerLite Account

1. Go to the settings view using the navigation.
2. Obtain the `apiToken` from your MailerLite dashboard account.
3. Put under the input field & hit Validate. Once done, the `apiToken` is stored in the database for future API requests.

### Add Subscriber

1. Use the subscriber form on the home page to create subscribers with the MailerLite API.

### Subscribers List

1. View the subscribers list using the navigation at the top of the page.
2. Data is fetched using an AJAX request and displayed.
3. Use navigation buttons to paginate through data.
4. Filter subscribers by email using DataTables search.
5. Limit of the subscibers can be changed using the dropdown available.