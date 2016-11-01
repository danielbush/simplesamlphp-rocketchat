FROM jnyryan/simplesamlphp

# Ensure simplesaml can log:
RUN mkdir -p /var/simplesamlphp/log
RUN chown -R www-data /var/simplesamlphp/log

# I think this was a gotcha before...
RUN chown -R www-data:www-data /var/lib/php5

# Enable example auth module.
RUN touch /var/simplesamlphp/modules/exampleauth/enable
