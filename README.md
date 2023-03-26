# Laravel MailerLite Integration

This project is a Laravel application that integrates with the MailerLite API to manage subscribers. The application is built using Laravel ^8.75 and PHP ^7.4.

# Getting Started

Follow these steps to set up and run the Laravel MailerLite Integration project in your local environment.

## Step 1: Clone the repository

Clone the project repository from the provided Git URL.

```bash
git clone https://github.com/MrEhsanEllahi/integration-engineer-assignment.git
```
## Step 2: Change to the project directory

Navigate to the project directory.

```bash
cd integration-engineer-assignment
```

## Step 3: Install dependencies

Install the required dependencies using Composer.

```bash
composer install
```

## Step 4: Create the .env file

Create a new .env file by copying the provided .env.example.

```bash
cp .env.example .env
```

## Step 5: Generate an application key

Generate an application key for your Laravel project.

```bash
php artisan key:generate
```

## Step 6: Import SQL File

There is no need to run `php artisan migration` command. Just import the sql file available under `Database->sql` directory.

## Step 7: Configure the .env file

Edit the .env file to set up the required configuration values, such as the database connection and MailerLite API token and endpoint.

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

MAILERLITE_API_TOKEN=your_mailerlite_api_token
MAILERLITE_API_ENDPOINT=your_mailerlite_api_endpoint
```
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

### MailerLite Keys

To ensure the working of app 100%, make sure that the key `MAILERLITE_API_ENDPOINT` is set in `.env` file. And tests will work only if `MAILERLITE_API_TOKEN` is also set under `.env` file.

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

### Edit Subscriber

1. Click on the email from the table or the edit icon under the actions table.
2. Update the name or country of the user in the opened form.
3. Save the changes.

### Delete Subscriber

1. Click on the trash icon under the actions table.
2. Remove the subscriber using an AJAX request. No redirect will happen.
3. Upon successful removal, the row will be removed from the table.

### Error Handling

1. For any error, exception, or success, a toast message will be shown with an informative message.
2. Each action will log the message properly into the database for effective troubleshooting.
3. Access the logs by visiting the `Runtime Logs` view using the navigation.