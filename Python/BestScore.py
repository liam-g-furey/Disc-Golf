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
	for (x,y) in winner.items():
		Best[x] = min(y)
	Best = dict(sorted(Best.items(), key=lambda item: item[1]))
	with open('ScriptFiles/Best_scores.csv',mode="w") as best_file:
		best_writer = csv.writer(best_file, delimiter=',', quotechar='"',quoting=csv.QUOTE_MINIMAL)
		best_writer.writerow(['Name', 'Score Over Par'])
		for (i,j) in Best.items():
			best_writer.writerow([i, str(j)])			
best_score()