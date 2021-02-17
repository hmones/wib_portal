sudo sysctl vm.overcommit_memory=1
sudo sysctl -w vm.max_map_count=262144
docker-compose start
cd laradock_wib
docker-compose exec workspace php artisan scout:import "App\Models\User"
docker-compose exec workspace php artisan scout:import "App\Models\Entity"
docker-compose exec workspace php artisan scout:import "App\Models\Post"
