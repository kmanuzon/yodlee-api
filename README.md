# Yodlee API SDK for PHP
A library for accessing financial data from
[Yodlee API](https://developer.yodlee.com/Yodlee_API). Built for easier
integration with Laravel PHP Framework as a dependency.

## Code Example
```php
<?php
// NOTE: This script assumes installation with composer and using composer's autoloader.
require_once 'vendor/autoload.php';

// Minimum required Yodlee credentials.
$yodleeApiUrl = 'https://developer.api.yodlee.com/ysl/restserver/v1';
$yodleeApiCobrandLogin = 'johndoe';
$yodleeApiCobrandPassword = 'johndoe#123';

// Create a new instance of the SDK.
$yodleeApi = new \YodleeApi\Client($yodleeApiUrl);

// Login the cobrand.
$yodleeApi->cobrand()->login($yodleeApiCobrandLogin, $yodleeApiCobrandPassword);

// Fetch all available banks, institutions etc. that are supported by Yodlee.
$providers = $yodleeApi->providers()->get();
```

Check the **examples/** directory for sample scripts.

## Installation with Composer
`composer require progknife/yodlee-api`

## API Reference

### `cobrand()`
| Return | Method | Description |
|----|----|----|
| bool | `login(string $username, string $password)` | Authenticates the cobrand. |
| void | `logout()` | Ends the authenticated cobrand's session from Yodlee. |

### `user()`
| Return | Method | Description |
|----|----|----|
| bool | `login(string $username, string $password)` | Authenticates the user. |
| void | `logout()` | Ends the authenticated user's session. |
| int\|bool | `register(string $username, string $password, string $email)` | Register and authenticates the user to Yodlee. |
| void | `unregister()` | Deletes the authenticated user's data from Yodlee. |

### `providers()`
| Return | Method | Description |
|----|----|----|
| array | `get([array $filters])` | Fetch all providers supported by Yodlee. Refer to [Yodlee API Documentation](https://developer.yodlee.com/apidocs/index.php#!/providers/getSuggestedSiteDetail) for filters parameter. |
| object | getDetail(int $providerId) | Fetch the provider details including the login form.

### `providerAccounts()`
| Return | Method | Description |
|----|----|----|
| object | `find(int $providerAccountId)` | Fetch the provider account by ID. |
| array | `get()` | Fetch all provider accounts added by the authenticated user. |
| object | `add(int $providerId, array $fields)` | Add a provider to user. Refer to [Yodlee API Documentation](https://developer.yodlee.com/apidocs/index.php#!/providerAccounts/addAccount) for more details on _$fields_ parameter. |
| object | `update(string $providerAccountIds, array $credentialsParam)`| Update one or multiple provider account. |
| void | `delete(int $providerAccountId)` | Delete the provider account. |

### `transactions()`
| Return | Method | Description |
|----|----|----|
| array | `get([array $filters])` | Fetch all transactions of the authenticated user. Refer to [Yodlee API Documentation](https://developer.yodlee.com/apidocs/index.php#!/transactions/getTransactions) for filters parameter. |
