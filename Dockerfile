FROM php:8.2-cli

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy application files
COPY . .

# Set permissions
RUN chmod -R 755 data && \
    chmod 666 data/tickets.json

# Expose port
EXPOSE 10000

# Start PHP server
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
```

#### **Step 3: Update `.gitignore`**

Make sure you have:
```
/vendor/
.env
.DS_Store