#!/bin/bash

docker-compose stop
docker-compose up -d --build --remove-orphans
docker-compose ps
