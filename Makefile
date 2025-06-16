### ——————————————————————————————————————————————————————————————————
### —— Local Makefile
### ——————————————————————————————————————————————————————————————————

include vendor/badpixxel/php-sdk/make/sdk.mk

.PHONY: upgrade
upgrade:
	$(MAKE) up
	$(DOCKER_COMPOSE) exec app composer update

.PHONY: verify
verify:	# Verify Code
	php vendor/bin/grumphp run --testsuite=travis
	php vendor/bin/grumphp run --testsuite=csfixer
	php vendor/bin/grumphp run --testsuite=phpstan

.PHONY: phpstan
phpstan:	# Execute Php Stan
	php vendor/bin/grumphp run --testsuite=phpstan

.PHONY: test
test: 	## Execute Functional Test in All Containers
	$(MAKE) up
	$(DOCKER_COMPOSE) exec app php vendor/bin/phpunit
