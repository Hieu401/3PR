FROM postgres:latest
COPY ./init.sql /docker-entrypoint-initdb.d
ENV POSTGRES_USER=3pr
ENV POSTGRES_PASSWORD=1234
ENV POSTGRES_DB=authdb