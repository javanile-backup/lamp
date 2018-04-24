#!/bin/bash

## Clone repository
git clone https://github.com/javanile/lamp lamp

## Create symblink for docker-compose.yml
cp lamp/docker-compose.yml docker-compose.yml

## Create symblink for docker-compose.yml
cp lamp/.lamp.env .lamp.env

## Run docker environment
docker-compose up -d --build

## Print out container status
docker-compose ps
