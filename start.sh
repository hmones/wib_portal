sudo sysctl vm.overcommit_memory=1
sudo sysctl -w vm.max_map_count=262144
cd laradock_wib
docker-compose start && sleep 30 &&
docker-compose exec workspace php artisan scout:import "App\Models\User"
docker-compose exec workspace php artisan scout:import "App\Models\Entity"
docker-compose exec workspace php artisan scout:import "App\Models\Post"
