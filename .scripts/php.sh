# Execute PHP command in the app container
docker-compose -f $PWD/docker-compose.yml exec app php $@
