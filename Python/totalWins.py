import sys
import os
import csv
def total_winner():
	direct = "games/"
	total_Wins = {}
	for file in os.listdir(direct):
		if file!= '.' and file!="..":
			f = open(direct+file, 'r')
			next(f)
			winner = {}
			for line in f: 
				categories = line.split(',')
				if categories[0] != 'Par':
					winner[categories[0]] = categories[4]
			mini = 1000
			winner_person = ""
			for (x,y) in winner.items():
				if int(y) < mini:
					mini = int(y)
					winner_person = x
			if winner_person in total_Wins.keys():
				total_Wins[winner_person] = total_Wins[winner_person] + 1
			else:
				total_Wins[winner_person] = 1
	total_Wins = dict(sorted(total_Wins.items(), key=lambda item: item[1]))
	#for (i,j) in total_Wins.items():
	#	print(i + "'s games won : " + str(j))
	with open('ScriptFiles/Total_Wins.csv',mode="w") as best_file:
		best_writer = csv.writer(best_file, delimiter=',', quotechar='"',quoting=csv.QUOTE_MINIMAL)
		best_writer.writerow(['Name', 'Wins'])
		for (i,j) in total_Wins.items():
			best_writer.writerow([i, str(j)])	

total_winner()