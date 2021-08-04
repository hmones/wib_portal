#!/bin/bash
set -x

systemctl stop apache2.service
systemctl stop mysql.service
./vendor/bin/sail up -d

