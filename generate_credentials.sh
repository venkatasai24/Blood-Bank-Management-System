#!/bin/bash

# Generate random username
SUPERUSER_USERNAME="superuser"

# Generate a random password
SUPERUSER_PASSWORD=$(openssl rand -base64 16)

# Define your .env file path
ENV_FILE=".env"

# Check if the .env file already exists
if [ -f "$ENV_FILE" ]; then
    # Inject or update the variables in the .env file
    sed -i "s/SUPERUSER_USERNAME=.*/SUPERUSER_USERNAME=$SUPERUSER_USERNAME/" $ENV_FILE
    sed -i "s/SUPERUSER_PASSWORD=.*/SUPERUSER_PASSWORD=$SUPERUSER_PASSWORD/" $ENV_FILE
else
    # Create a new .env file with the variables
    echo "SUPERUSER_USERNAME=$SUPERUSER_USERNAME" >> $ENV_FILE
    echo "SUPERUSER_PASSWORD=$SUPERUSER_PASSWORD" >> $ENV_FILE
fi

echo "Credentials generated and injected into $ENV_FILE"
echo "Username: $SUPERUSER_USERNAME"
echo "Password: $SUPERUSER_PASSWORD"