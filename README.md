# 透過docker 建立PHP開發環境
Nginx
MySQL & phpmyadmin
PHP7
ELK
Mongodb & Mongo-express
Redis & php-redis-admin
rabbitmq & rabbitmq-management

![Demo Image](./dnmp.png)

# 1. 準備docker & git
Mac
```
brew install docker docker-compose docker-machine xhyve docker-machine-driver-xhyve
```

Ubuntu
```
$ curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

$ sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"

$ sudo apt-get update

$ apt-cache policy docker-ce

$ sudo apt-get install -y docker-ce git

$ sudo systemctl status docker

$ sudo usermod -aG docker ${USER}

$ docker

$ sudo curl -L https://github.com/docker/compose/releases/download/1.18.0/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose

$ sudo chmod +x /usr/local/bin/docker-compose

$ docker-compose --version
```


## 2. 使用
1. Clone project:
    ```
    $ git clone https://github.com/babyandy0111/dev-dnmp.git
    ```
2. Start docker containers:
    ```
    $ cd dev-dnmp
    $ docker-compose up -d php nginx ...
    ```
3. 打開 http://localhost 你會看到 site1 預設畫面

## 3. 想用其他php版本?
Default, we start LATEST PHP version by using:
```
$ docker-compose up
```
we can also start PHP5.4 or PHP5.6 by using:
```
$ docker-compose -f docker-compose54.yml up
$ docker-compose -f docker-compose56.yml up
```
We need not change any other files, such as nginx config file or php.ini, everything will work fine in current environment (except code compatibility error).

> Notice: We can only start one php version, for they using same port. We must STOP the running project then START the other one.

## 4. HTTPS and HTTP/2
Default demo include 2 sites:
* http://www.site1.com (same with http://localhost)
* https://www.site2.com

To preview them, add 2 lines to your hosts file (at `/etc/hosts` on Linux and `C:\Windows\System32\drivers\etc\hosts` on Windows):
```
127.0.0.1 www.site1.com
127.0.0.1 www.site2.com
```
Then you can visit from browser.


## 5. Use log
We can identify log directory in nginx / php / php-fpm / mysql config file.
To display the log file in host, we should config them to `/var/log/dnmp`.

But, there are some differences:

### 5.1 Nginx log
Nginx will auto generate all log files.

### 5.2 PHP-FPM log
To use `php-fpm` log, you must create log file manually(in host):
```bash
$ touch log/php.fpm.error.log
$ chmod a+w log/php.fpm.error.log
```
### 5.3 MySQL log
Same as `php-fpm`, log file must be created manually(in host):
```bash
$ touch log/mysql.slow.log
$ chmod a+w log/mysql.slow.log
```

## 6. Debug
Xdebug
```
https://medium.com/@dadakao/%E4%BD%BF%E7%94%A8phpstorm-debugger%E9%99%A4%E9%8C%AFdocker-container%E5%85%A7%E7%9A%84php%E7%A8%8B%E5%BC%8F-1ebd16017464
```

laravel ide helper
```
$ composer require "doctrine/dbal: ~2.3"

$ php artisan vendor:publish --provider="Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider" --tag=config


```

## 7. License
MIT