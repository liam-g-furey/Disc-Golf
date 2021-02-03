#!/usr/bin/env python3
import sys
import os
import csv
def best_score():
	direct = "games/"
	winner = {}
	for file in os.listdir(direct):
		if file!= '.' and file!="..":
			f = open(direct+file, 'r')
			next(f)
			for line in f: 
				categories = line.split(',')
				if categories[0] != 'Par':
					if categories[0] not in winner.keys():
						l = [(categories[3], int(categories[5]))]
						winner[categories[0]] = l
					else:
						winner[categories[0]].append((categories[3], int(categories[5])))
	Best = {}
	for (x,y) in winner.items():
		with open('ScriptFiles/Scores'+x+'.csv',mode="w") as best_file:
			best_writer = csv.writer(best_file, delimiter=',', quotechar='"',quoting=csv.QUOTE_MINIMAL)
			best_writer.writerow(['Date', 'Score Over Par'])
			for (i,j) in y:
				best_writer.writerow([i, str(j)])			
best_score()