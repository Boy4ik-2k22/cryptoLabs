install:
	@composer install
crypto:
	@./bin/crypto
cezar:
	@./Lab-1/cezar/bin/cezar
xor:
	@./Lab-1/xor/bin/xor
validate:
	@composer validate
lint:
	@composer exec --verbose phpcs -- --standard=PSR12 Lab-1 bin
fix:
	@composer exec --verbose phpcbf -- --standard=PSR12 Lab-1 bin