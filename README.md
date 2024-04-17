# Peroxide: API-Skeleton
API skeleton on top of Slim and OpenSwoole for microsservices projects focused on performance and simplicity

# How to install
Using *composer* to install the skeleton:
```bash
# install using openswoole binaries
$  docker run \
        -u 1000:1000 \
        -w /var/www \
        -v .:/var/www --rm \
         openswoole/swoole:php8.3-dev \
         create-project peroxide/api-skeleton <you_project_dir>
```

Or

```bash
         
$ composer create-project \
      --ignore-platform-reqs \
      peroxide/api-skeleton <you_project_dir>
```
**Attention**: Running composer without **--ignore-platform-reqs** will display error, because you need openswoole as 
 PHP extension.
# Setup
Create your local **.env** file
```bash
$ cp .env.example .env
```

---

There's no special commands to start the local server, you need **docker** and **compose** executing as yous system user

To run as *docker compose*
```bash
$ docker compose up -d
```

# Testing
```bash
$ curl http://localhost:8080/check-health
```

# Quality tools
Code sniffer
```bash
./exec composer sniff
```

CS Fixer
```bash
./exec composer fix
```

Tests with PHPUnit
```bash
./exec composer test
```

PHPStan
```bash
./exec composer stan
```

Mess Detector
```bash
./exec composer md
```


# Attention!
This skeleton server runs on the OpenSwoole runtime, enabling executions through coroutines. 

It's crucial to be mindful of socket communications, using PDO with Postgres can block the event loop, 
while MySQL with PDO is compatible (swoole handles communication for you). 

For Postgres, consider utilizing the Postgres Client instead. Be diligent in vetting any other communication methods 
before implementation to preempt any unforeseen issues down the line.

For more informations about blocking event loop please check the documents: https://openswoole.com/