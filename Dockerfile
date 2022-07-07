FROM mariadb:latest

COPY ./cpd_mystery.sql /docker-entrypoint-initdb.d