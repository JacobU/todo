# Notes

Built with Laravel Sail.

Run `sudo vendor/bin/sail up` to start running the project.

Run `sudo vendor/bin/sail test` to run tests


# Issues on ubuntu
On Ubuntu, had to run two commands to stop mysql and apache2 from running on the ports the `docker-compose` specifies that docker will use:
```
sudo service mysql stop && sudo service apache2 stop
```

If you are using the server or local environment as a user that is not root, run:
```
export UID=$(id -u)
export GID=$(id -g)
```