#!/usr/bin/env bash

if [[ $EUID -ne 0 ]]; then
    echo '[!] This script must be run as root.'
    exit 1
fi

fail() {
    echo '[!]' $1 && exit 1
}

echo '[+] Pulling most recent changes...'
#git pull || fail 'git pull failed'

echo '[+] Clearing old web files'
rm -r /var/www/disc/* || fail 'Failed to clear files'

echo '[+] Adding new files'
cp -Rp ./* /var/www/disc/ \
    && mkdir /var/www/disc/ScriptFiles \
    && sudo chown -R aidan:www-data /var/www/disc \
    && rm /var/www/disc/deploy.sh \
    && rm /var/www/disc/README.md \
    || fail 'Failed to add new files'

echo '[+] Running scripts...'
$(cd /var/www/disc && python3 Python/totalWins.py) || fail 'Failed to run totalWins.py'
$(cd /var/www/disc && python3 Python/BestScore.py) || fail 'Failed to run BestScore.py'
$(cd /var/www/disc && python3 Python/WorstScore.py) || fail 'Failed to run WorstScore.py'
$(cd /var/www/disc && python3 Python/ScoresChart.py) || fail 'Failed to run ScoresChart.py'
$(cd /var/www/disc && python3 Python/WeightedAveragePerformance.py) || fail 'Failed to run WeightedAveragePerformance.py'

echo '[+] Done!'