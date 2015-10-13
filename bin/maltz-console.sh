#!/bin/bash

declare PROJECT_LOCATION="/home/pedro/projects/maltz"
declare DEV_HOST_LOCATION="/var/www/maltz"
declare MEDIA_BACKUP_DIR="/tmp/maltzmediabackup"

function maltz_git_pull {
    cd $PROJECT_LOCATION
    git pull origin master
}

function maltz_git_push {
    cd $PROJECT_LOCATION
    git push origin master
}

function maltz_git_drop_stash {
    cd $PROJECT_LOCATION
    git stash
    git stash clear
}

function maltz_git_commit {
    local COMMENT=$1
    cd $PROJECT_LOCATION
    git add .
    git commit -m $COMMENT
}

function maltz_gen_vhost {
    local VHOST="/tmp/maltzvhost"
    echo <<EOF
<VirtualHost *:80>
    ServerName maltz.local

    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/maltz
    #LogLevel info ssl:warn

    <Directory /var/www/maltz>
        AllowOverride all
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF > $VHOST
    }

function maltz_cp_and_en_apache_site {
    local VHOST="/tmp/maltzvhost"
    cd $PROJECT_LOCATION
    cp $VHOST /etc/apache2/sites-avaiable/maltz.conf
    a2enmod rewrite
    a2ensite maltz
}

function maltz_update_etchosts {

}

function maltz_update_vendor {
    cd $PROJECT_LOCATION
    composer update
}

function maltz_backup_media {
    rsync -avz "$DEV_HOST_LOCATION"/public/media/* "$MEDIA_BACKUP_DIR"/
}

function maltz_load_db_schema {
    mysql -uroot -proot maltz < "$PROJECT_LOCATION"/sql/shema.sql
}

function maltz_load_db_dump {
    mysql -uroot -proot maltz < "$PROJECT_LOCATION"/sql/dump.sql
}

function maltz_dump_db {
    mysqldump -uroot -proot maltz > "$PROJECT_LOCATION"/sql/dump.sql
}

function maltz_sync {
    rm -rf "$DEV_HOST_LOCATION"/*
    rsync --exclude '.git' -avz "$PROJECT_LOCATION"/ "$DEV_HOST_LOCATION"/
}

function maltz_run_tests {
    cd $PROJECT_LOCATION
    phpunit
}

function maltz_run_and_log_tests {
    cd $PROJECT_LOCATION
    phpunit > unit.log
}

function maltz_generate_package {
    local PACKAGE=$1
}

function maltz_generate_model {
    local PACKAGE=$1
    local NAME=$2
}

function maltz_generate_ctrl {
    local PACKAGE=$1
    local NAME=$2
}

function maltz_build_package {
    local PACKAGE=$1
    # remove unused stuff
}

function maltz_usage {

}

function main {
    if [[ $1 == 'git' ]]; then
        if [[ $2 == 'push' ]]; then
            maltz_git_push
        elif [[ $2 == 'pull' ]]; then
            maltz_git_pull
        elif [[ $2 == 'commit' ]]; then
            maltz_git_commit $2
        elif [[ $2 == 'drop' ]]; then
            maltz_git_drop_stash
    elif [[ $1 == 'db' ]]; then
        if [[ $2 == 'load' ]]; then
            maltz_load_db_schema
        elif [[ $2 == 'dump' ]]; then
            maltz_dump_db
        elif [[ $2 == 'load-dump' ]]; then
            maltz_load_db_dump
    elif [[ $1 == 'test' ]]; then
        if [[ $2 == 'run' ]]; then
            maltz_run_tests
        elif [[ $2 == 'run-log' ]]; then
            maltz_run_and_log_tests
    elif [[ $1 == 'media' ]]; then
        if [[ $2 == 'backup' ]]; then
            maltz_backup_media
        elif [[ $2 == 'restore' ]]; then
    elif [[ $1 == 'apache' ]]; then
        if [[ $2 == 'activate' ]]; then
            maltz_cp_and_en_apache_site
        elif [[ $2 == 'sync' ]]; then
            maltz_sync
        elif [[ $2 == 'deploy' ]]; then
            maltz_cp_and_en_apache_site
            maltz_sync
    elif [[ $1 == 'generate' ]]; then
        if [[ $2 == 'package' ]]; then
            maltz_generate_package $2
        elif [[ $2 == 'model' ]]; then
            maltz_generate_model $2 $3
        elif [[ $2 == 'ctrl' ]]; then
            maltz_generate_ctrl $2 $3

    else; then
        maltz_usage
    fi
}

# check for:
# is sudo
# is composer installed locally OR in path
# is git installed

main $@
