#!/bin/bash
set -x
sleep 30 &&
docker exec laradock_wib_workspace_1 php artisan scout:import "App\Models\User"
docker exec laradock_wib_workspace_1 scout:import "App\Models\Entity"
docker exec laradock_wib_workspace_1 php artisan scout:import "App\Models\Post"
