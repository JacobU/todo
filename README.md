# Notes

./vendor is not included in the repo

On Ubuntu, had to run two commands to stop mysql and apache2 from running on the ports the `docker-compose` file uses:
```
sudo service mysql stop && sudo service apache2 stop
```

