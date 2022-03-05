install:
	@composer install
crypto:
	@./bin/crypto
validate:
	@composer validate
lint:
	@composer exec --verbose phpcs -- --standard=PSR12 Lab-1 bin
fix:
	@composer exec --verbose phpcbf -- --standard=PSR12 Lab-1 bin