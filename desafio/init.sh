#!/bin/sh
# docker-compose build
docker-compose up -d
sleep 3
docker-compose up -d migrate
docker-compose up -d --force-recreate app