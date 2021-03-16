#!/usr/bin/python3

import os
import sys
import csv

def getCourses():
    courses = {}
    with open('data/courses.csv') as f:
        reader = csv.DictReader(f)
        for row in reader:
            courses[int(row['ID'])] = f"{row['Location']} - {row['Name']}"
    return courses

def getSeasons():
    choices = {
        1: 'Season 1',
        2: 'Season 2'
    }
    return choices

def select(choiceDict: dict, prompt: str):
    print(prompt)
    for item_id, item_name in choiceDict.items():
        print(f"\t{item_id}: {item_name}")
    entry = input('> ')

    if entry.isdigit() and (i_id := int(entry)) in choiceDict.keys():
        out = (i_id, choiceDict[i_id])
    else:
        print('[-] Invalid option.')
        return False

    print('[+] Selected:', out[1])
    return out

def readGame(filename):
    stats = {}
    with open(filename) as f:
        headers = f.readline().split(',')
        f.readline() # skip par

        while (line := f.readline()):
            cols = line.split(',')
            name = cols[0] if cols[0] != 'Discer' else 'Aidan'
            stats[name] = [int(cols[headers.index('Total')])]
            for idx in range(1, len(cols)):
                if headers[idx].startswith('Hole'):
                    stats[name].append(int(cols[idx].rstrip()))
    
    if '/' in filename:
        filename = filename.split('/')[-1]
    date = filename.split()[0]
    return (date, stats)

def main(filename):
    if not (course := select(getCourses(), '[+] Which course was this game?')):
        return
    if not (season := select(getSeasons(), '[+] Which season is this for?')):
        return
    
    date, stats = readGame(filename)
    headers = ['Date','CourseID','Player','Total','H1','H2','H3','H4','H5','H6','H7','H8','H9','H10','H11','H12','H13','H14','H15','H16','H17','H18','H19','H20']
    with open(f'data/season{season[0]}.csv', 'a') as f:
        w = csv.writer(f)
        for player, scores in stats.items():
            data = [date, course[0], player]
            data.extend(scores)
            w.writerow(data)

    print('[+] Successfully added games.')
    choices = { 1: 'Yes, delete it.', 2: 'No, keep it.' }
    if not (act := select(choices, '[+] Delete original UDisc file?')):
        print('[-] Defaulting to keeping file.')
    else:
        os.remove(filename)

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print(f"Usage: {sys.argv[0]} <game file>")
        exit(1)
    
    main(sys.argv[1])
