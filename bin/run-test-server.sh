#!/usr/bin/env bash

# https://github.com/Codeception/Codeception/issues/5246
MYPDO_ENV=test APP_DIR="$PWD" php -d display_errors -d auto_prepend_file="$PWD/vendor/autoload.php" -S localhost:8080 -t public/ &
PID=$!

# https://unix.stackexchange.com/a/427133/464332
# wait on the parent process id
tail --pid=$PPID -f /dev/null
# Mac (untested)
# lsof -p $PPID +r 1 &>/dev/null

# kill off php web server
kill -15 -- $PID