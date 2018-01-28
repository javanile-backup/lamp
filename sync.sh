#!/bin/bash

cd `dirname $0`

git pull
git add .
git add *
git commit -m "sync"
git push

cd ..
docker-compose stop
docker-compose up -d --build --remove-orphans
docker-compose ps
