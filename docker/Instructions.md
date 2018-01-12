docker-compose exec --user=1000:1000 php composer create-project symfony/skeleton ./
docker-compose exec --user=1000:1000 php composer require annotations
docker-compose exec --user=1000:1000 php composer require --dev profiler
docker-compose exec --user=1000:1000 php composer require twig
docker-compose exec --user=1000:1000 php composer require maker
docker-compose exec --user=1000:1000 php composer require orm    or   composer require doctrine maker
docker-compose exec --user=1000:1000 php composer require validator

docker-compose exec --user=1000:1000 php composer require sonata-project/admin-bundle
docker-compose exec --user=1000:1000 php composer require sonata-project/doctrine-orm-admin-bundle
docker-compose exec --user=1000:1000 php composer req asset

docker-compose exec --user=1000:1000 php composer req admin
docker-compose exec --user=1000:1000 php composer require vich/uploader-bundle
docker-compose exec --user=1000:1000 php composer req security

docker-compose exec --user=1000:1000 php composer require twbs/bootstrap:4.0.0-beta.3


#https://github.com/FriendsOfSymfony/FOSUserBundle/pull/2639
docker-compose exec --user=1000:1000 php composer require swiftmailer-bundle
docker-compose exec --user=1000:1000 php composer require friendsofsymfony/user-bundle "dev-master"



#### Fix permissions (you can skip if command/init-dist-files.sh executed):
    cd ~/sites/symfony && sudo setfacl -R -m u:82:rwX -m u:`whoami`:rwX backend
    cd ~/sites/symfony && sudo setfacl -dR -m u:82:rwX -m u:`whoami`:rwX backend
   
#### Console comands
docker-compose exec --user=1000:1000 php php bin/console debug:router
docker-compose exec --user=1000:1000 php php bin/console list make
docker-compose exec --user=1000:1000 php php bin/console debug:autowiring

