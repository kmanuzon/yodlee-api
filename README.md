# Yodlee API SDK for PHP
A library for accessing financial data from
[Yodlee API](https://developer.yodlee.com/Yodlee_API). Built for easier
integration with Laravel PHP Framework as a dependency.

## Code Example
```
<?php
// Create a new instance of the SDK.
$yodlee = new \Yodlee\Api\Factory('restserver');

// Login the cobrand.
$yodlee->cobrand()->login('user1234', 'pass1234');

// Fetch all available bank, institutions etc. supported by Yodlee.
$providers = $yodlee->providers()->get();
```

Check the **examples/** directory for configuration and more usage samples.

## Installation with Composer
`composer require progknife/yodlee-api`

## API Reference

### `cobrand()`
* `login(string $username, string $password)` Authenticates the cobrand.
* `logout()` Ends the authenticated cobrand's session.

### `user()`
* `login(string $username, string $password)` Authenticates the user.
* `logout()` Ends the authenticated user's session.
* `register(string $username, string $password, string $email)` Register and authenticates the user to Yodlee.
* `unregister()` Deletes the authenticated user's account from Yodlee.

### `providers()`
* `get([array $filters])` Fetch all available providers.
* `getDetails(int $providerId)` Fetch a provider's details including the login form.

### `providerAccounts()`
* `add(int $providerId, array $fields)` Add a provider to user. Refer to [Yodlee API Documentation](https://developer.yodlee.com/apidocs/index.php#!/providerAccounts/addAccount) for more details on _$fields_ parameter.

### `transactions()`
* `get([array $filters])` Fetch all available transactions of the authenticated user.
