#!/bin/sh
set -e

echo "Running init-db.sh script..."

export $(grep -v '^#' .env.docker | xargs)

# Wait for MySQL to be available
until mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e 'SELECT 1'; do
    >&2 echo "MySQL is unavailable - sleeping"
    sleep 5
done
echo "MySQL is up - continuing"
# Create database and user
mysql -u root -p"$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS $DB_DATABASE;
    CREATE USER IF NOT EXISTS '$DB_USERNAME'@'%' IDENTIFIED BY '$DB_PASSWORD';
    GRANT ALL PRIVILEGES ON $DB_DATABASE.* TO '$DB_USERNAME'@'%';
    FLUSH PRIVILEGES;
EOSQL

echo "Database and user setup completed."
