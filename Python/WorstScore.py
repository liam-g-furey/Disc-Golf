import sys
import os
import csv
def worst_score():
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
		Best[x] = max(y)
	Best = dict(sorted(Best.items(), key=lambda item: item[1]))
	with open('ScriptFiles/Worst_scores.csv',mode="w") as worst_file:
		worst_writer = csv.writer(worst_file, delimiter=',', quotechar='"',quoting=csv.QUOTE_MINIMAL)
		worst_writer.writerow(['Name', 'Score Over Par'])
		for (i,j) in Best.items():
			worst_writer.writerow([i, str(j)])
		#print(i + "'s worst game was " + str(j) + " strokes over par")
			
worst_score()