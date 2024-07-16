# Owner Avatar: Dynamique-Redirection-4QRCode

## Project Description

Dynamique-Redirection-4QRCode is a PHP-based project designed to facilitate dynamic URL redirection for QR codes. This project includes an administration panel where URLs can be set and modified. The main index page redirects users to the specified URL based on the current configuration.

## Features

1. **Dynamic Redirection**: Redirects users to a specified URL configured in the admin panel.
2. **Admin Panel**: Allows administrators to set, modify, and disable the redirection URL.
3. **Pre-configured Buttons**: Provides quick redirection options with editable URLs, titles, and colors.
4. **Password Protection**: Secure access to the admin panel.
5. **Responsive Design**: User-friendly interface suitable for mobile devices.

## Installation

1. **Navigate to the Project Directory**:
    ```
    cd owner-avatar-dynamique-redirection-4qrcode
    ```

2. **Set Up Configuration**:
    - Open `config/config.php` and set your admin password.

    ```php
    <?php
    $adminPassword = 'your_password';
    ```

3. **Ensure File Permissions**:
    - Make sure `url_storage.txt` and `button_urls.json` are writable by the web server.

    ```
    chmod 666 url_storage.txt
    chmod 666 button_urls.json
    ```

## Usage

1. **Access the Admin Panel**:
    - Go to `admin.php` in your browser.
    - Enter the password set in the configuration file.

2. **Set or Modify Redirection URL**:
    - Enter the desired URL in the input field and click "Update URL".

3. **Use Pre-configured Buttons**:
    - Click on any pre-configured button to set the redirection URL quickly.
    - To edit the URL, title, or color of a button, click the pencil icon next to the button, fill in the fields in the popup, and save.

4. **Disable Redirection**:
    - Click the "Disable Redirection" button to stop any redirection.

## License

This project is licensed under the MIT License. See the LICENSE file for details.