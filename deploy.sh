#!/usr/bin/env bash

if [[ $EUID -ne 0 ]]; then
    echo '[!] This script must be run as root.'
    exit 1
fi

fail() {
    echo '[!]' $1 && exit 1
}

echo '[+] Pulling most recent changes...'
git pull || fail 'git pull failed'

echo '[+] Clearing old web files'
rm -r /var/www/disc/* || fail 'Failed to clear files'

echo '[+] Adding new files'
cp -Rp ./* /var/www/disc/ \
    && sudo chown -R aidan:www-data /var/www/disc \
    && rm /var/www/disc/deploy.sh \
    && rm /var/www/disc/README.md \
    || fail 'Failed to add new files'

echo '[+] Running scripts...'
cd /var/www/disc
python3 Python/genData.py || fail 'Failed to run genData.py'
#python3 Python/ScoresChart.py || fail 'Failed to run ScoresChart.py'
#python3 Python/WeightedAveragePerformance.py || fail 'Failed to run WeightedAveragePerformance.py'
rm -r Python || fail 'Failed to remove Python scripts'
cd - >/dev/null

echo '[+] Done!'