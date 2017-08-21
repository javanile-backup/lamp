#!/bin/bash

## Clone repository
git clone https://github.com/javanile/docker-compose-lamp lamp

## Create symblink for docker-compose.yml
ln -s lamp/docker-compose.yml docker-compose.yml
