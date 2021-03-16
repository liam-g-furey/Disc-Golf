from csv import writer
from json import dump

import libdisc as disc

"""
Generates data for the most recent season:
    - Raw scores (data/raw<#>.json)
    - Statistics By Person (data/stats<#>.json)
        - Total wins
        - Avg score
        - Best score
        - Worst score
"""

def main():

    stats_by_person = {}
    season = disc.getMostRecentSeason()
    if not (games := disc.getGamesBySeason(season)):
        return False

    for game in games:
        if not (course := disc.getCourseById(game['courseID'])):
            continue
        par = int(course['Par'])
        for player in game['players']:
            overPar = player['total'] - par
            if player['name'] in stats_by_person:
                stats_by_person[player['name']]['best'] = min(
                    stats_by_person[player['name']]['best'],
                    overPar
                )
                stats_by_person[player['name']]['worst'] = max(
                    stats_by_person[player['name']]['worst'],
                    overPar
                )
                stats_by_person[player['name']]['games'].append(
                    overPar
                )
            else:
                stats_by_person[player['name']] = {
                    'wins': 0,
                    'best': overPar,
                    'worst': overPar,
                    'games': [overPar]
                }
        winners = disc.getWinners(game)
        for name in winners:
            stats_by_person[name]['wins'] += 1
        
    for name, stats in stats_by_person.items():
        stats_by_person[name]['avg'] = round(sum(stats['games']) / len(stats['games']), 2)
        del stats_by_person[name]['games']
    
    disc.writeGamesToJSON(games, f'raw{season}.json')
    with open(f'data/stats{season}.json', 'w') as f:
        dump(stats_by_person, f)

if __name__ == '__main__':
    main()
