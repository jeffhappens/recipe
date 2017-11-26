#!/bin/sh

rsync -avz --no-perms --no-owner --no-group --exclude-from=/Users/jeffreymills/Sites/recipe/exclude.txt . root@162.243.254.18:/var/www/html/
