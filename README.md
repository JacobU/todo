# Notes

Built with Laravel Sail.

Run `sudo vendor/bin/sail up` to start running the project.

./vendor is not included in the repo

On Ubuntu, had to run two commands to stop mysql and apache2 from running on the ports the `docker-compose` specifies that docker will use:
```
sudo service mysql stop && sudo service apache2 stop
```

