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

Check the **examples/** directory for more usage samples and configuration.

## Installation with Composer
`composer require progknife/yodlee-api`

## API Reference

### `cobrand()`
| Return | Method | Description |
|----|----|----|
| bool | `login(string $username, string $password)` | Authenticates the cobrand. |
| bool | `logout()` | Ends the authenticated cobrand's session. |

### `user()`
| Return | Method | Description |
|----|----|----|
| bool | `login(string $username, string $password)` | Authenticates the user. |
| bool | `logout()` | Ends the authenticated user's session. |
| int\|bool | `register(string $username, string $password, string $email)` | Register and authenticates the user to Yodlee. |
| bool | `unregister()` | Deletes the authenticated user data from Yodlee. |

### `providers()`
| Return | Method | Description |
|----|----|----|
| array | `get([array $filters])` | Fetch all providers supported by Yodlee. |
| object | getDetail(int $providerId) | Fetch the provider details including the login form.

### `providerAccounts()`
| Return | Method | Description |
|----|----|----|
| object | `find(int $providerAccountId)` | Fetch the provider account by ID. |
| array | `get()` | Fetch all provider accounts added by the authenticated user. |
| object | `add(int $providerId, array $fields)` | Add a provider to user. Refer to [Yodlee API Documentation](https://developer.yodlee.com/apidocs/index.php#!/providerAccounts/addAccount) for more details on _$fields_ parameter. |
| object | `update(string $providerAccountIds, array $credentialsParam)`| Update one or multiple provider account. |
| bool | `delete(int $providerAccountId)` | Delete the provider account. |

### `transactions()`
| Return | Method | Description |
|----|----|----|
| array | `get([array $filters])` | Fetch all transactions of the authenticated user. |
