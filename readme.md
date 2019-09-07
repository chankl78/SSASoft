## SSA Portal

# Getting started

1. Git clone this repository
2. Download Docker
3. for mac add the following line to ~/.bashrc:
  * eval "$(docker-machine env default)"

# to execute following steps simply run `source docker/cw1_rundocker`, after that current terminal will run 
1. In the repository folder, run `docker build --tag=ssa-img docker`
  * The second `docker` refers to the folder containing "dockerfile"
  * You may change the tag `ssa-img` to any name you want
2. Run `docker run --name=ssa-run -p 80:80 ssa-img`
  * This runs the image as a container called "ssa-run", while exposing port 80
  * You may change the container name `ssa-run` to any name you want

# open another terminal tab
# to execute following steps, simply run `source docker/cw2_execdocker`
1. Copy the source code to docker: `docker cp /path/to/code ssa-run:/var/www/laravel`
2. Composer install: `docker exec ssa-run cd /var/www/laravel;composer install`
3. Create initial database: `docker exec ssa-run mysql -u root -pWorldsoft10! -e "CREATE DATABASE SSAPortal"`
4. Set permissions: `docker exec ssa-run chown -R www-data:www-data /var/www/laravel/app/storage`

# run `source docker/cw2b_runsecuritysql`  to update database with security.sql (without needing to recreate user account)
# to update changes run `source docker/cw3_updatecode`
# to launch mysql run `source docker/cw5_mysql` 
# hack to gain admin access: 
1. add a user name "testing" using portal
2. run `source docker/sqladminhack`
