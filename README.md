# GamerBoxd
It's like LetterBoxd but for games.

# requirements
docker  

# instructions
download all files in forum/ folder
inside project folder run the following command
'docker-compose up -d'
main site: http://localhost:8080
phpAdmin: http://localhost:8081

## possible mysqli() error (solution for now..)
after creating the container, go into the apache container bash and execute the following command and restart container
'docker-php-ext-install mysqli'