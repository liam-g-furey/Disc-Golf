import datetime
import json
import csv
import os
import re

"""
Library to perform common operations on disc data.

Works with courses and season data files in the data
directory; prerequisite is addGame.py
"""

def getMostRecentSeason(basePath='.'):
    season = 0
    data_dir = os.path.join(basePath, 'data')
    for filename in os.listdir(data_dir):
        if re.match(r'^season\d+\.csv$', filename):
            num = filename.split('season')[1].split('.')[0]
            season = max(season, int(num))
    return season

def getWinners(game: dict):
    if 'winners' in game:
        return game['winners']
    winners = (game['players'][0]['total'], game['players'][0]['name'])
    for idx in range(1, len(game['players'])):
        if game['players'][idx]['total'] < winners[0]:
            winners = (game['players'][idx]['total'], game['players'][idx]['name'])
        elif game['players'][idx]['total'] == winners[0]:
            winners = winners + (game['players'][idx]['name'],)
    _, *names = winners
    return names

def getGamesBySeason(season: int, basePath='.'):
    season_file = os.path.join(basePath, 'data', f'season{season}.csv')
    if not os.path.isfile(season_file):
        return False
    
    games = []
    with open(season_file) as f:
        reader = csv.DictReader(f)
        curGame = (None, None)
        for row in reader:
            dateCol = row['Date'].split('-')
            date = datetime.date(int(dateCol[0]), int(dateCol[1]), int(dateCol[2]))
            scores = [int(val) for key, val in row.items() if val and re.match(r'^H\d+$', key)]
            player = { 'name': row['Player'], 'total': int(row['Total']), 'scores': scores }
            if (date, row['CourseID']) != curGame:
                curGame = (date, row['CourseID'])
                games.append({ 'date': date, 'courseID': int(row['CourseID']), 'players': [] })
            games[-1]['players'].append(player)

    for game in games:
        game['winners'] = getWinners(game)
    return games

def getCourseById(course_id: int, basePath='.'):
    courses_file = os.path.join(basePath, 'data', 'courses.csv')
    if not os.path.isfile(courses_file):
        return False
    
    course = False
    with open(courses_file) as f:
        reader = csv.DictReader(f)
        for row in reader:
            if int(row['ID']) == course_id:
                course = row
                break
    return course

def getMostRecentGame(games: dict):
    recent = (games[0]['date'], 0)
    for idx in range(1, len(games)):
        if (g := games[idx]['date']) > recent[0]:
            recent = (g, idx)
    return games[recent[1]]

def writeGamesToJSON(games: dict, filename: str, basePath='.'):
    game_file = os.path.join(basePath, 'data', filename)
    for game in games:
        # Store date as YYYY-MM-DD
        game['date'] = f'{game["date"]:%Y-%m-%d}'
    with open(game_file, 'w') as f:
        json.dump(games, f)
