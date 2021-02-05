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
						l = [int(categories[5])]
						winner[categories[0]] = l
					else:
						winner[categories[0]].append(int(categories[5]))
	Best = {}

	with open('ScriptFiles/Averages.csv',mode="w") as best_file:
		best_writer = csv.writer(best_file, delimiter=',', quotechar='"',quoting=csv.QUOTE_MINIMAL)
		for (x,y) in winner.items():
			avg = sum(y)/len(y)
			best_writer.writerow([x, avg])			
best_score()