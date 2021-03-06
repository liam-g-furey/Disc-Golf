from sys import argv
from os import listdir
from csv import DictReader, writer

"""
Generates the following statistics for all existing game files (unformatted):
- Total wins
- Average score
- Best overall score
- Worst overall score

Presence of any command line arguments trigger debug mode.
Generates "ScriptFiles/stats.csv".
"""

def getStats(csv_file: str):
    """
    Returns unionable dict with player names as keys and tuple of stats as values. Stats are win (bool) and strokes over (int).
    """
    stats = {}
    with open(csv_file) as f:
        best_score = 100
        reader = DictReader(f)
        par = int(next(reader)['Total'])
        for player in reader:
            strokes_over = int(player['+/-'])
            stats[player['PlayerName']] = (0, strokes_over)
            best_score = min(best_score, strokes_over)
        for key, value in stats.items():
            if value[1] == best_score:
                stats[key] = (1, value[1])
    return stats

def writeStats(outfile: str, stats: dict):
    headers = ['Player', 'Wins', 'Average Score', 'Best Score', 'Worst Score']
    with open(outfile, 'w', newline='') as f:
        w = writer(f)
        w.writerow(headers)
        for player, data in stats.items():
            w.writerow([player, data['wins'], data['avg'], data['best'], data['worst']])

def main(debug: bool):
    base_dir = 'games/'
    stats_by_person = {}
    for file_name in listdir(base_dir):
        if 'formatted' in file_name:
            continue
        date = file_name.split()[0]
        courses = file_name.split(' - ')[1].split('.')[0]
        courses = [x.replace('_',' ') for x in courses.split('_&_')]
        data = getStats(base_dir + file_name)
        for player, stats in data.items():
            if player in stats_by_person:
                stats_by_person[player]['wins'] += stats[0]
                stats_by_person[player]['best'] = min(stats_by_person[player]['best'], stats[1])
                stats_by_person[player]['worst'] = max(stats_by_person[player]['worst'], stats[1])
                stats_by_person[player]['games'].append(stats[1])
            else:
                stats_by_person[player] = {
                    'wins': stats[0],
                    'best': stats[1],
                    'worst': stats[1],
                    'games': [stats[1]]
                }
    for player, stats in stats_by_person.items():
        stats_by_person[player]['avg'] = round(sum(stats['games']) / len(stats['games']), 2)
    if debug:
        for player, stats in stats_by_person.items():
            print(player, stats)
    else:
        writeStats('ScriptFiles/stats.csv', stats_by_person)

if __name__ == '__main__':
    if len(argv) > 1:
        print('[#] Running in debug mode...')
        main(True)
    else:
        main(False)
