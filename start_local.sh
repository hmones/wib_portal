#!/bin/bash
set -x

sudo systemctl stop apache2.service
sudo systemctl stop mysql
sudo sysctl vm.overcommit_memory=1
sudo sysctl -w vm.max_map_count=262144
cd laradock_wib
docker-compose start
cd ..
