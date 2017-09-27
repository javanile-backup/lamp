#!/bin/bash

## Clone repository
git clone https://github.com/javanile/lamp lamp

## Create symblink for docker-compose.yml
ln -s lamp/docker-compose.yml docker-compose.yml

## Run docker environment
docker-compose up -d --build

## Print out container status
docker-compose ps
