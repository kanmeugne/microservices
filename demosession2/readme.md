# Start docker (if not started)
sudo dockerd 

# mount services
sudo docker-compose -f stack.yml up

# clean
sudo docker-compose rm -v 
