# Set working directory
WORKDIR /var/www/html

# Copy Laravel app code
COPY . /var/www/html

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Make start.sh executable
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Expose port 80
EXPOSE 80

# Start the script
CMD ["/usr/local/bin/start.sh"]
