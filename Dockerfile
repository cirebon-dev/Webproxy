FROM caddy:2-builder AS builder

RUN xcaddy build --with github.com/baldinof/caddy-supervisor

FROM php:8.2-fpm-alpine

COPY --from=builder /usr/bin/caddy /usr/bin/caddy
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions
RUN install-php-extensions @composer
COPY . .
RUN chown -R www-data:www-data .
EXPOSE 8080
CMD ["caddy", "run"]