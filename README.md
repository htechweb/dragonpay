
<h1 align="center">
	<a href="https://www.htechcorp.net/" target="_blank"><img src="https://www.htechcorp.net/images/logo_small.png" alt="Htechcorp"></a>
	<a href="https://www.dragonpay.ph/" target="_blank"><img src="https://www.dragonpay.ph/wp-content/uploads/2019/04/mini-logo.png" alt="Dragonpay"></a>
	<br>
	Htech x Dragonpay
	<br>
</h1>

# Installation
```
	composer require htech/dragonpay
```
# Usage
No documentation yet. But we created some examples. Run in CLI.
```
	php artisan vendor:publish --tag=dp_examples
```
then run migration
```
	php artisan migrate
```

Please don't forget to set merchant id and password in the env.
```
	DP_MERCHANT_ID ="MERCHANT ID" 
	DP_PASSWORD ="MERCHANT SECRET KEY"
```
You may also try examples  <a href="http://dev72.htechcorp.net/zik/dragonpay/public/">here</a>

### Troubleshooting
- If you have problems in installing with lower versions of PHP. Try adding params `ignore-platform-reqs` in composer require
```
	composer require htech/dragonpay --ignore-platform-reqs 
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The GNU General Public License v3.0 (GNU GPLv3). Please see [License File](LICENSE.md) for more information.

#### Author
Zik M.