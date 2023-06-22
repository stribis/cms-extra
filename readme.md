# B-Board Example Project

This is an example project for the PHP CMS lessons.
Please be aware that many steps were skipped in this project, since it is just meant for repetition, so please do not use it as an example for safe and secure code.

## Technology

* PHP 8.2 and above.
* MySQL Server version 10.4.27-MariaDB
* Apache Server

## Configuration

* Edit config.php to fit your development/deployment environment
* Edit Model/DB.php with your database, user and password.
```php
  protected $dbName = 'cms-example'; /** Database Name */
  protected $dbHost = 'localhost'; /** Database Host */
  protected $dbUser = 'root';      /** Database Root */
  protected $dbPass = 'root';      /** Database Password */
  protected $dbHandler, $dbStmt;
```

## Structure

This project uses the MVC pattern to separate data structures from views from control logic.
For simplicity, views are contained directly in the root and controllers and models can be found in their corresponding folders.

## Potential Improvements
**Validation** 
* In general, validation was kept super simple to save time during class.
* Enforce password complexity requirements: Implement rules for strong passwords and enforce them during user registration or password changes. This can include a minimum length, a mix of uppercase and lowercase letters, numbers, and special characters.

**Security**
* Inputs could be sanitized a lot better.
* Protect against Cross-Site Request Forgery (CSRF) attacks: Implement CSRF protection to prevent unauthorized requests from malicious sites. Generate and validate CSRF tokens for each authenticated action or form submission. You can use PHP's csrf_token function or utilize a CSRF protection library.
* Secure cookie handling: Cookies should be handled securely. Use the 'Secure' flag to ensure cookies are only transmitted over HTTPS. Additionally, use the 'HttpOnly' flag to prevent access to cookies via JavaScript, which protects against cross-site scripting (XSS) attacks.
* Expiration and token rotation: Set an appropriate expiration time for the remember-me cookies. In the example, the cookies are set to expire after 30 days. You can adjust this value to fit your needs. Additionally, consider implementing token rotation, where a new token is generated and stored in the cookie on each successful login, and the old token is invalidated.
* Protection against brute force attacks: Implement measures to prevent brute force attacks, such as rate limiting login attempts, using CAPTCHA, or implementing account lockouts after multiple failed login attempts.

**Structure**
* Views could be separated into their own views directory.
* Routing could be done with a dedicated router.

**Code**
* Code would benefit from static functions.

**AND SO ON ...**